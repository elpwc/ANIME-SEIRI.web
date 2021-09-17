@echo off
title sass convertor
setlocal enabledelayedexpansion
for /r . %%i in (*.scss) do (
  echo CURRENTLY: %%i
  set "s=%%i"
  sass %%i !s:~0,-5!.css -s compressed
)
::wzh 2021/9/17 19:14