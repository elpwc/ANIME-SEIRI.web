@echo off
setlocal enabledelayedexpansion
title sass convertor

set "t="
set "j=0"

if not exist cv_temp md cv_temp

for /r %%i in (*.scss) do (
echo [!j!]CURRENT: %%i

echo Generate file name..
set t=%%i
set t=!t:~0,-5!

echo %%i>cv_temp\_sass_convert_tempfilename1_!j!
echo !t!.css>cv_temp\_sass_convert_tempfilename2_!j!

rem 在同一个脚本内的for内执行sass的话，会导致第二次循环开始变量延迟全部失效，所以输出为外部文件再运行
echo Generate executable file..
echo ^cd cv_temp>cv_temp\_sass_convert_tempcmd_!j!.bat
echo ^set /p former^=^<_sass_convert_tempfilename1_!j!>>cv_temp\_sass_convert_tempcmd_!j!.bat
echo ^set /p after^=^<_sass_convert_tempfilename2_!j!>>cv_temp\_sass_convert_tempcmd_!j!.bat
echo ^sass ^"%%former%%^" ^"%%after%%^" -s compressed^&^&^exit>>cv_temp\_sass_convert_tempcmd_!j!.bat

echo Executing..
start cv_temp\_sass_convert_tempcmd_!j!.bat

set /a j+=1
)

echo.
echo Done. Start to clean _*.css ^& temp files.
rem 不延时会因为没有停止异步的运行而删除失败
ping 127.0.0.1>nul & ping 127.0.0.1>nul
del /s /q _*.css
del /s /q _*.css.map
rd /s /q cv_temp

echo.
echo Done. Press Any keys to exit.
pause>nul
exit

::wzh 2021/9/17 19:14 create
::wzh 2021/9/21 04:10 update
::wzh 2021/9/21 15:33 little update