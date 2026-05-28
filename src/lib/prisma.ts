import { PrismaClient } from "@prisma/client";
import { PrismaMariaDb } from "@prisma/adapter-mariadb";

const globalForPrisma = globalThis as unknown as {
  prisma?: PrismaClient;
};

const adapter = new PrismaMariaDb(
  process.env.DATABASE_URL ?? "mysql://root:password@127.0.0.1:3306/rumah_coding_next",
);

export const prisma =
  globalForPrisma.prisma ??
  new PrismaClient({ adapter, log: process.env.NODE_ENV === "development" ? ["error", "warn"] : ["error"] });

if (process.env.NODE_ENV !== "production") {
  globalForPrisma.prisma = prisma;
}
