import { cookies } from "next/headers";
import { redirect } from "next/navigation";
import { jwtVerify, SignJWT } from "jose";

export const roles = ["SUPER_ADMIN", "ADMIN", "EDITOR", "SUPPORT"] as const;

export type Role = (typeof roles)[number];

export type SessionUser = {
  id: string;
  name: string;
  email: string;
  role: Role;
};

const demoUser: SessionUser = {
  id: "demo-admin",
  name: "Admin Rumah Coding",
  email: process.env.ADMIN_EMAIL ?? "admin@rumahcoding.local",
  role: "SUPER_ADMIN",
};

const sessionCookie = "rc_admin_session";
const secret = new TextEncoder().encode(
  process.env.AUTH_SECRET ?? "local-development-secret-change-before-production",
);

function isRole(value: unknown): value is Role {
  return typeof value === "string" && roles.includes(value as Role);
}

export async function getCurrentUser() {
  const store = await cookies();
  const token = store.get(sessionCookie)?.value;

  if (!token) {
    return null;
  }

  try {
    const { payload } = await jwtVerify(token, secret);
    const role = isRole(payload.role) ? payload.role : null;

    if (!role || typeof payload.email !== "string" || typeof payload.name !== "string") {
      return null;
    }

    return {
      id: payload.sub ?? "admin",
      name: payload.name,
      email: payload.email,
      role,
    };
  } catch {
    return null;
  }
}

export async function createAdminSession() {
  const token = await new SignJWT({
    name: demoUser.name,
    email: demoUser.email,
    role: demoUser.role,
  })
    .setProtectedHeader({ alg: "HS256" })
    .setSubject(demoUser.id)
    .setIssuedAt()
    .setExpirationTime("8h")
    .sign(secret);

  const store = await cookies();
  store.set(sessionCookie, token, {
    httpOnly: true,
    sameSite: "lax",
    secure: process.env.NODE_ENV === "production",
    path: "/",
    maxAge: 60 * 60 * 8,
  });
}

export async function clearAdminSession() {
  const store = await cookies();
  store.delete(sessionCookie);
}

export async function requireRole(allowedRoles: Role[]) {
  const user = await getCurrentUser();

  if (!user) {
    redirect("/login");
  }

  if (!allowedRoles.includes(user.role)) {
    redirect("/");
  }

  return user;
}
