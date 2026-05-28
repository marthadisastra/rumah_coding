"use client";

import { useActionState } from "react";
import { loginAdmin } from "@/actions/auth";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";

const initialState = {
  message: "",
};

export function LoginForm() {
  const [state, action, pending] = useActionState(loginAdmin, initialState);

  return (
    <form action={action} className="flex flex-col gap-4">
      <div className="flex flex-col gap-2">
        <Label htmlFor="email">Email</Label>
        <Input id="email" name="email" type="email" placeholder="admin@rumahcoding.local" />
      </div>
      <div className="flex flex-col gap-2">
        <Label htmlFor="password">Password</Label>
        <Input id="password" name="password" type="password" />
      </div>
      {state.message ? <p className="text-sm text-destructive">{state.message}</p> : null}
      <Button disabled={pending}>{pending ? "Checking..." : "Masuk admin"}</Button>
    </form>
  );
}
