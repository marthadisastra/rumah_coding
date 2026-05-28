"use server";

import bcrypt from "bcryptjs";
import { redirect } from "next/navigation";
import { clearAdminSession, createAdminSession } from "@/lib/auth";

type LoginState = {
  message: string;
};

function getAdminPassword() {
  if (process.env.ADMIN_PASSWORD) {
    return process.env.ADMIN_PASSWORD;
  }

  if (process.env.NODE_ENV !== "production") {
    return "admin12345";
  }

  return null;
}

async function passwordMatches(password: string) {
  if (process.env.ADMIN_PASSWORD_HASH) {
    return bcrypt.compare(password, process.env.ADMIN_PASSWORD_HASH);
  }

  const configuredPassword = getAdminPassword();
  return configuredPassword ? password === configuredPassword : false;
}

export async function loginAdmin(_: LoginState, formData: FormData): Promise<LoginState> {
  const email = String(formData.get("email") ?? "").trim().toLowerCase();
  const password = String(formData.get("password") ?? "");
  const adminEmail = (process.env.ADMIN_EMAIL ?? "admin@rumahcoding.local").toLowerCase();

  if (email !== adminEmail || !(await passwordMatches(password))) {
    return { message: "Email atau password admin tidak sesuai." };
  }

  await createAdminSession();
  redirect("/admin");
}

export async function logoutAdmin() {
  await clearAdminSession();
  redirect("/login");
}
