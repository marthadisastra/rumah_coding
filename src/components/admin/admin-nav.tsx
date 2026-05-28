import Link from "next/link";
import {
  BookOpenText,
  CircleHelp,
  FileCode2,
  Gauge,
  LayoutTemplate,
  MessageSquareText,
  RadioTower,
  ReceiptText,
  UsersRound,
} from "lucide-react";

const items = [
  { href: "/admin", label: "Overview", icon: Gauge },
  { href: "/admin/blog", label: "Blog", icon: BookOpenText },
  { href: "/admin/portfolio", label: "Portfolio", icon: LayoutTemplate },
  { href: "/admin/faqs", label: "FAQs", icon: CircleHelp },
  { href: "/admin/pricing", label: "Pricing", icon: ReceiptText },
  { href: "/admin/leads", label: "Leads", icon: UsersRound },
  { href: "/admin/whatsapp", label: "WhatsApp", icon: MessageSquareText },
  { href: "/admin/webhooks", label: "Webhooks", icon: RadioTower },
  { href: "/docs/api", label: "API docs", icon: FileCode2 },
];

export function AdminNav() {
  return (
    <aside className="hidden w-64 shrink-0 border-r bg-muted/25 lg:block">
      <div className="sticky top-0 flex h-screen flex-col gap-6 px-4 py-5">
        <Link href="/" className="flex items-center gap-2 text-sm font-semibold">
          <span className="flex size-7 items-center justify-center rounded-md bg-primary text-xs text-primary-foreground">
            RC
          </span>
          Admin
        </Link>
        <nav className="flex flex-col gap-1">
          {items.map((item) => (
            <Link
              key={item.href}
              href={item.href}
              className="flex items-center gap-3 rounded-md px-3 py-2 text-sm text-muted-foreground transition hover:bg-background hover:text-foreground"
            >
              <item.icon />
              {item.label}
            </Link>
          ))}
        </nav>
      </div>
    </aside>
  );
}
