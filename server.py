# server.py — SATU FILE UNTUK SEMUA API (copy seluruhnya!)
from flask import Flask, jsonify
import mysql.connector
from datetime import datetime
from flask_cors import CORS

app = Flask(__name__)
CORS(app)

# KONEKSI DATABASE
db_config = {
    'host': 'localhost',
    'user': 'root',
    'password': '',
    'database': 'siskolah',
    'port': 3306
}

def get_conn():
    return mysql.connector.connect(**db_config)

# ========== LINE CHART (KEUANGAN BULANAN) ==========
@app.route('/api/keuangan-bulanan')
def keuangan_bulanan():
    try:
        conn = get_conn()
        cursor = conn.cursor(dictionary=True)
        query = """
            SELECT
                DATE_FORMAT(tanggal, '%Y-%m') AS bulan,
                SUM(CASE WHEN jenis = 'Pemasukan' THEN jumlah ELSE 0 END) AS pemasukan,
                SUM(CASE WHEN jenis = 'Pengeluaran' THEN jumlah ELSE 0 END) AS pengeluaran
            FROM keuangan
            GROUP BY DATE_FORMAT(tanggal, '%Y-%m')
            ORDER BY bulan ASC
        """
        cursor.execute(query)
        rows = cursor.fetchall()

        data = []
        for row in rows:
            bulan_date = datetime.strptime(row['bulan'] + '-01', '%Y-%m-%d')
            nama_bulan = bulan_date.strftime('%B %Y')
            data.append({
                'bulan': nama_bulan,
                'pemasukan': float(row['pemasukan'] or 0),
                'pengeluaran': float(row['pengeluaran'] or 0)
            })
        cursor.close()
        conn.close()
        return jsonify(data)
    except Exception as e:
        return jsonify({"error": str(e)}), 500

# ========== PIE CHART (ABSENSI HARI INI) ==========
@app.route('/api/absensi-hari-ini')
def absensi_hari_ini():
    try:
        conn = get_conn()
        cursor = conn.cursor(dictionary=True)
        query = """
            SELECT 
                status,
                COUNT(*) AS jumlah
            FROM absensi_siswa 
            WHERE DATE(tanggal) = CURDATE()
            GROUP BY status
        """
        cursor.execute(query)
        rows = cursor.fetchall()

        # Kalau belum ada absensi hari ini, kasih default biar chart nggak error
        if not rows:
            default = [
                {"status": "Hadir", "jumlah": 0},
                {"status": "Izin", "jumlah": 0},
                {"status": "Sakit", "jumlah": 0},
                {"status": "Alpa", "jumlah": 0}
            ]
            return jsonify(default)

        data = [{"status": row['status'], "jumlah": int(row['jumlah'])} for row in rows]
        cursor.close()
        conn.close()
        return jsonify(data)
    except Exception as e:
        return jsonify({"error": str(e)}), 500

# ========== JALANKAN SERVER ==========
if __name__ == '__main__':
    print("Semua API Siskolah jalan di http://127.0.0.1:5000")
    app.run(port=5000, debug=True)