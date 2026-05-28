"use client";

import { useActionState } from "react";
import { createLead } from "@/actions/leads";
import { Button } from "@/components/ui/button";
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from "@/components/ui/card";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Textarea } from "@/components/ui/textarea";

const initialState = { ok: false, message: "" };

export function ContactForm() {
  const [state, action, pending] = useActionState(createLead, initialState);

  return (
    <Card>
      <CardHeader>
        <CardTitle>Route a lead</CardTitle>
        <CardDescription>Server action stub ready for Prisma persistence.</CardDescription>
      </CardHeader>
      <CardContent>
        <form action={action} className="flex flex-col gap-4">
          <div className="flex flex-col gap-2">
            <Label htmlFor="name">Name</Label>
            <Input id="name" name="name" placeholder="Aulia Rahman" />
          </div>
          <div className="grid gap-4 md:grid-cols-2">
            <div className="flex flex-col gap-2">
              <Label htmlFor="email">Email</Label>
              <Input id="email" name="email" type="email" placeholder="aulia@company.com" />
            </div>
            <div className="flex flex-col gap-2">
              <Label htmlFor="phone">WhatsApp</Label>
              <Input id="phone" name="phone" placeholder="+62" />
            </div>
          </div>
          <div className="flex flex-col gap-2">
            <Label htmlFor="message">Message</Label>
            <Textarea id="message" name="message" placeholder="Tell us about the training need." />
          </div>
          {state.message ? (
            <p className={state.ok ? "text-sm text-foreground" : "text-sm text-destructive"}>
              {state.message}
            </p>
          ) : null}
          <Button disabled={pending}>{pending ? "Saving..." : "Create lead"}</Button>
        </form>
      </CardContent>
    </Card>
  );
}
