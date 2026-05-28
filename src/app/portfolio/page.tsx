import type { Metadata } from "next";
import Link from "next/link";
import { ArrowRight } from "lucide-react";
import { MarketingFooter } from "@/components/marketing/footer";
import { MarketingHeader } from "@/components/marketing/header";
import { Badge } from "@/components/ui/badge";
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from "@/components/ui/card";
import { portfolioSummaries } from "@/services/cms";

export const metadata: Metadata = {
  title: "Portfolio",
  description: "Daftar software dan platform yang pernah dibangun untuk kebutuhan marketing, dashboard, dan operasional.",
};

export default function PortfolioPage() {
  return (
    <div className="min-h-screen bg-background">
      <MarketingHeader />
      <main className="mx-auto flex max-w-6xl flex-col gap-8 px-4 py-14">
        <div className="flex max-w-3xl flex-col gap-3">
          <h1 className="text-4xl font-semibold tracking-tight">Portfolio</h1>
          <p className="leading-7 text-muted-foreground">
            Kumpulan software, dashboard, dan website yang pernah saya bangun beserta konteks dan hasilnya.
          </p>
        </div>
        <div className="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
          {portfolioSummaries
            .filter((project) => project.status === "Published")
            .map((project) => (
              <Card key={project.slug} className="flex flex-col">
                <CardHeader className="gap-3">
                  <div className="flex items-center justify-between gap-3">
                    <Badge variant="outline">{project.category}</Badge>
                    <span className="text-sm text-muted-foreground">{project.year}</span>
                  </div>
                  <CardTitle className="leading-7">{project.name}</CardTitle>
                  <CardDescription className="leading-6">{project.summary}</CardDescription>
                </CardHeader>
                <CardContent className="mt-auto flex flex-col gap-4">
                  <div className="flex flex-wrap gap-2">
                    {project.stack.map((item) => (
                      <Badge key={item} variant="secondary">
                        {item}
                      </Badge>
                    ))}
                  </div>
                  <Link
                    href={`/portfolio/${project.slug}`}
                    className="inline-flex items-center gap-2 text-sm font-medium text-foreground"
                  >
                    Lihat detail
                    <ArrowRight className="size-4" />
                  </Link>
                </CardContent>
              </Card>
            ))}
        </div>
      </main>
      <MarketingFooter />
    </div>
  );
}
