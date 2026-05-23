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
for phrase in [
    'Admin Panel Login',
    'Admin Panel',
    'Kelola konten website',
    'Halo,',
    'Email atau password admin salah',
]:
    print(phrase, phrase in proc.stdout)
print('effective url maybe unknown, output length', len(proc.stdout))
