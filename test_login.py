import re
import subprocess
import pathlib

subprocess.run(["rm", "-f", "/tmp/login.html", "/tmp/admin_cookie"])
subprocess.run(["curl", "-s", "-c", "/tmp/admin_cookie", "http://localhost:8080/admin/login", "-o", "/tmp/login.html"])
html = pathlib.Path("/tmp/login.html").read_text()
cs = re.search(r'name="csrf_test_name" value="([^"]+)"', html)
if not cs:
    raise SystemExit('no csrf token')
token = cs.group(1)
proc = subprocess.run([
    "curl", "-s", "-L", "-b", "/tmp/admin_cookie", "-c", "/tmp/admin_cookie",
    "-e", "http://localhost:8080/admin/login",
    "-d", f"csrf_test_name={token}",
    "-d", "email=admin@rumahcoding.id",
    "-d", "password=Admin123!",
    "http://localhost:8080/admin/login"
], capture_output=True, text=True)
print('status', proc.returncode)
print('contains error', 'Email atau password admin salah' in proc.stdout)
print('contains csrf', 'csrf' in proc.stdout)
print('contains dashboard', 'dashboard' in proc.stdout)
print('contains login', 'login' in proc.stdout)
print('contains admin email value', 'value="admin@rumahcoding.id"' in proc.stdout)
print('contains old email', 'admin@rumahcoding.id' in proc.stdout)
print('--- snippet ---')
idx = proc.stdout.find('Email atau password admin salah')
if idx != -1:
    print(proc.stdout[idx-120:idx+120])
else:
    print(proc.stdout[:400])
