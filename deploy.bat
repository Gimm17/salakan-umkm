@echo off
echo.
echo ====================================================
echo   AUTOMATIC DEPLOYMENT - UMKM BANGGAI
echo ====================================================
echo.
echo Menghubungi server cPanel...

ssh -o Port=22 -o ConnectTimeout=10 -o StrictHostKeyChecking=no gimmhost@195.88.211.70 "cd /home/gimmhost/banggaiumkm.gimmhost.my.id && git fetch origin master && git reset --hard origin/master"

echo.
if %errorlevel% equ 0 (
    echo [SUKSES] Website berhasil diperbarui dengan kode terbaru dari GitHub!
) else (
    echo [GAGAL] Terjadi kesalahan saat menarik kode dari GitHub.
)
echo.
pause
