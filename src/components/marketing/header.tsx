import Link from "next/link";

const nav = [
  { href: "/portfolio", label: "Portfolio" },
  { href: "/blog", label: "Blog" },
  { href: "/pricing", label: "Pricing" },
  { href: "/docs/api", label: "API docs" },
];

export function MarketingHeader() {
  return (
    <header className="sticky top-0 z-20 border-b bg-background/90 backdrop-blur">
      <div className="mx-auto flex h-16 max-w-6xl items-center justify-between px-4">
        <Link href="/" className="flex items-center gap-2 text-sm font-semibold">
          <span className="flex size-7 items-center justify-center rounded-md border bg-primary text-xs text-primary-foreground">
            RC
          </span>
          Rumah Coding
        </Link>
        <nav className="hidden items-center gap-6 text-sm text-muted-foreground md:flex">
          {nav.map((item) => (
            <Link key={item.href} href={item.href} className="transition hover:text-foreground">
              {item.label}
            </Link>
          ))}
        </nav>
        <div className="hidden text-sm text-muted-foreground md:block"></div>
      </div>
    </header>
  );
}
