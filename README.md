## Description

The script allows the user to execute any command they want and easily display the results of that command. It opens a new process using the `proc_open()` function and configures pipes for returning the results. If the command is executed successfully, the output is displayed in a table format. Otherwise, the error message is displayed in red color.

- Note : I have never used any of these functions `exec()`, `system()`, `passthru()`, `shell_exec()`

## Functions used 

- `ini_get()`: used to retrieve the value of a specified configuration option in php.ini.
- `proc_open()`: used to open a new process using the given command and configure pipes for returning the results.
- `is_resource()`: used to check whether the given variables are resources or not.
- `stream_get_contents()`: used to retrieve the contents of a stream as a string.
- `fclose()`: used to close the specified stream.
- `proc_close()`: used to close the opened process and retrieve the exit code.

## Disclaimer
This script is for educational and testing purposes only. Do not use it to exploit on any system that you do not own or have permission to test. The author of this script are not responsible for any misuse or damage caused by its use.
