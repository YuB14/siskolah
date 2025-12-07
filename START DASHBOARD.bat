@echo off
title DASHBOARD SISKOLAH - SEDANG JALAN
echo.
echo =================================================
echo   DASHBOARD SISKOLAH OTOMATIS SEDANG DIMULAI
echo   Tutup jendela ini kalau mau matikan server
echo =================================================
echo.
cd /d "%~dp0"
python server.py
echo.
echo Server sudah mati. Tekan apa saja untuk keluar...
pause >nul