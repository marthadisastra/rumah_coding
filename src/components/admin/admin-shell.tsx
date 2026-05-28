import type { ReactNode } from "react";
import { logoutAdmin } from "@/actions/auth";
import { AdminNav } from "@/components/admin/admin-nav";
import { Button } from "@/components/ui/button";
import { requireRole } from "@/lib/auth";

export async function AdminShell({ children }: { children: ReactNode }) {
  const user = await requireRole(["SUPER_ADMIN", "ADMIN", "EDITOR", "SUPPORT"]);

  return (
    <div className="flex min-h-screen bg-background">
      <AdminNav />
      <div className="flex min-w-0 flex-1 flex-col">
        <header className="border-b">
          <div className="flex h-16 items-center justify-between px-4 md:px-8">
            <p className="text-sm text-muted-foreground">Production console</p>
            <div className="flex items-center gap-4">
              <div className="text-right">
                <p className="text-sm font-medium">{user.name}</p>
                <p className="text-xs text-muted-foreground">{user.role}</p>
              </div>
              <form action={logoutAdmin}>
                <Button size="sm" variant="outline">
                  Logout
                </Button>
              </form>
            </div>
          </div>
        </header>
        <main className="flex-1 px-4 py-6 md:px-8">{children}</main>
      </div>
    </div>
  );
}
