import type { Metadata } from "next";
import { LockKeyhole } from "lucide-react";
import { LoginForm } from "@/components/admin/login-form";
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from "@/components/ui/card";

export const metadata: Metadata = {
  title: "Sign in",
  description: "Admin authentication entry for Rumah Coding.",
};

export default function LoginPage() {
  return (
    <main className="flex min-h-screen items-center justify-center bg-muted/30 px-4">
      <Card className="w-full max-w-sm">
        <CardHeader>
          <div className="mb-2 flex size-9 items-center justify-center rounded-md border bg-background">
            <LockKeyhole />
          </div>
          <CardTitle>Sign in</CardTitle>
          <CardDescription>Masuk untuk mengelola konten dan operasional website.</CardDescription>
        </CardHeader>
        <CardContent>
          <LoginForm />
        </CardContent>
      </Card>
    </main>
  );
}
