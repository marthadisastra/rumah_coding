"use server";

import { z } from "zod";

const leadSchema = z.object({
  name: z.string().min(2),
  email: z.string().email(),
  phone: z.string().optional(),
  message: z.string().min(10),
});

export async function createLead(_: unknown, formData: FormData) {
  const payload = leadSchema.safeParse({
    name: formData.get("name"),
    email: formData.get("email"),
    phone: formData.get("phone"),
    message: formData.get("message"),
  });

  if (!payload.success) {
    return { ok: false, message: "Please complete the required fields." };
  }

  return { ok: true, message: "Lead captured. Connect Prisma persistence when the database is ready." };
}
