import Link from "next/link";
import { ArrowRight, CheckCircle2, TerminalSquare } from "lucide-react";
import { ContactForm } from "@/components/marketing/contact-form";
import { MarketingFooter } from "@/components/marketing/footer";
import { MarketingHeader } from "@/components/marketing/header";
import { Badge } from "@/components/ui/badge";
import { Button } from "@/components/ui/button";
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from "@/components/ui/card";
import { Separator } from "@/components/ui/separator";
import { dashboardStats, portfolioSummaries } from "@/services/cms";

const capabilities = [
  "CMS publishing workflow",
  "Pricing and FAQ governance",
  "Lead routing and qualification",
  "WhatsApp gateway telemetry",
  "Webhook and API observability",
  "Role-based admin access",
];

export default function Home() {
  return (
    <div className="min-h-screen bg-background text-foreground">
      <MarketingHeader />
      <main>
        <section className="mx-auto grid max-w-6xl gap-10 px-4 py-20 md:grid-cols-[1.05fr_0.95fr] md:items-center">
          <div className="flex flex-col gap-7">
            <div className="flex flex-col gap-5">
              <h1 className="max-w-3xl text-4xl font-semibold tracking-tight md:text-6xl">
                A calmer operating layer for Rumah Coding.
              </h1>
              <p className="max-w-2xl text-lg leading-8 text-muted-foreground">
                A separate Next.js platform for marketing pages, CMS operations, lead capture,
                WhatsApp activity, and API documentation while the existing CodeIgniter app keeps running.
              </p>
            </div>
            <div className="flex flex-col gap-3 sm:flex-row">
              <Button asChild>
                <Link href="/pricing">
                  View pricing
                  <ArrowRight data-icon="inline-end" />
                </Link>
              </Button>
              <Button asChild variant="outline">
                <Link href="/docs/api">Read API docs</Link>
              </Button>
            </div>
          </div>
          <Card className="overflow-hidden">
            <CardHeader className="border-b">
              <div className="flex items-center gap-2 text-sm text-muted-foreground">
                <TerminalSquare />
                Platform status
              </div>
              <CardTitle>Migration-ready console</CardTitle>
              <CardDescription>Designed for reverse proxy deployment later.</CardDescription>
            </CardHeader>
            <CardContent className="grid gap-0 p-0">
              {dashboardStats.map((stat, index) => (
                <div key={stat.label}>
                  <div className="flex items-center justify-between px-5 py-4">
                    <div>
                      <p className="text-sm text-muted-foreground">{stat.label}</p>
                      <p className="text-2xl font-semibold">{stat.value}</p>
                    </div>
                    <span className="text-sm text-muted-foreground">{stat.change}</span>
                  </div>
                  {index < dashboardStats.length - 1 ? <Separator /> : null}
                </div>
              ))}
            </CardContent>
          </Card>
        </section>

        <section className="border-y bg-muted/30">
          <div className="mx-auto grid max-w-6xl gap-10 px-4 py-16 md:grid-cols-[0.8fr_1.2fr]">
            <div className="flex flex-col gap-3">
              <h2 className="text-2xl font-semibold tracking-tight">Built as a clean second system.</h2>
              <p className="leading-7 text-muted-foreground">
                The app is isolated from the legacy CodeIgniter project and can mature behind a
                subdomain or reverse proxy before any traffic migration.
              </p>
            </div>
            <div className="grid gap-3 sm:grid-cols-2">
              {capabilities.map((capability) => (
                <div key={capability} className="flex items-center gap-3 rounded-md border bg-background p-4">
                  <CheckCircle2 className="text-muted-foreground" />
                  <span className="text-sm font-medium">{capability}</span>
                </div>
              ))}
            </div>
          </div>
        </section>

        <section className="mx-auto flex max-w-6xl flex-col gap-8 px-4 py-16">
          <div className="flex flex-col gap-3 md:flex-row md:items-end md:justify-between">
            <div className="max-w-2xl">
              <h2 className="text-2xl font-semibold tracking-tight">Selected portfolio</h2>
              <p className="mt-2 leading-7 text-muted-foreground">
                Beberapa software dan platform yang pernah saya kerjakan, lengkap dengan konteks masalah dan hasil implementasinya.
              </p>
            </div>
            <Button asChild variant="outline">
              <Link href="/portfolio">Open portfolio</Link>
            </Button>
          </div>
          <div className="grid gap-4 md:grid-cols-3">
            {portfolioSummaries.slice(0, 3).map((project) => (
              <Card key={project.slug}>
                <CardHeader className="gap-3">
                  <div className="flex items-center justify-between gap-3">
                    <Badge variant="outline">{project.category}</Badge>
                    <span className="text-sm text-muted-foreground">{project.year}</span>
                  </div>
                  <CardTitle>{project.name}</CardTitle>
                  <CardDescription className="leading-6">{project.summary}</CardDescription>
                </CardHeader>
                <CardContent className="flex flex-col gap-4">
                  <div className="flex flex-wrap gap-2">
                    {project.stack.slice(0, 3).map((item) => (
                      <Badge key={item} variant="secondary">
                        {item}
                      </Badge>
                    ))}
                  </div>
                  <Link href={`/portfolio/${project.slug}`} className="text-sm font-medium">
                    View case study
                  </Link>
                </CardContent>
              </Card>
            ))}
          </div>
        </section>

        <section className="mx-auto grid max-w-6xl gap-10 px-4 py-16 md:grid-cols-[0.95fr_1.05fr]">
          <div className="flex flex-col justify-center gap-3">
            <h2 className="text-2xl font-semibold tracking-tight">Lead capture is ready to persist.</h2>
            <p className="leading-7 text-muted-foreground">
              The form uses a server action with validation. Connect it to Prisma once the MySQL
              database is provisioned for the Next.js app.
            </p>
          </div>
          <ContactForm />
        </section>
      </main>
      <MarketingFooter />
    </div>
  );
}
