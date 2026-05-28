import type { Metadata } from "next";
import Link from "next/link";
import { notFound } from "next/navigation";
import { ExternalLink } from "lucide-react";
import { MarketingFooter } from "@/components/marketing/footer";
import { MarketingHeader } from "@/components/marketing/header";
import { Badge } from "@/components/ui/badge";
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
import { getPortfolioBySlug, getPortfolioSlugs } from "@/services/cms";

type PortfolioDetailPageProps = {
  params: Promise<{
    slug: string;
  }>;
};

export async function generateStaticParams() {
  return getPortfolioSlugs().map((slug) => ({ slug }));
}

export async function generateMetadata({ params }: PortfolioDetailPageProps): Promise<Metadata> {
  const { slug } = await params;
  const project = getPortfolioBySlug(slug);

  if (!project) {
    return {
      title: "Portfolio",
    };
  }

  return {
    title: project.name,
    description: project.summary,
  };
}

export default async function PortfolioDetailPage({ params }: PortfolioDetailPageProps) {
  const { slug } = await params;
  const project = getPortfolioBySlug(slug);

  if (!project) {
    notFound();
  }

  return (
    <div className="min-h-screen bg-background">
      <MarketingHeader />
      <main className="mx-auto flex max-w-5xl flex-col gap-10 px-4 py-14">
        <div className="grid gap-8 lg:grid-cols-[1.3fr_0.7fr]">
          <div className="flex flex-col gap-4">
            <div className="flex flex-wrap items-center gap-3">
              <Badge variant="outline">{project.category}</Badge>
              <span className="text-sm text-muted-foreground">{project.year}</span>
              <span className="text-sm text-muted-foreground">{project.client}</span>
            </div>
            <h1 className="text-4xl font-semibold tracking-tight">{project.name}</h1>
            <p className="text-lg leading-8 text-muted-foreground">{project.headline}</p>
            <p className="leading-8 text-foreground/90">{project.summary}</p>
            {project.website ? (
              <Link
                href={project.website}
                className="inline-flex items-center gap-2 text-sm font-medium"
                target="_blank"
                rel="noreferrer"
              >
                Visit project
                <ExternalLink className="size-4" />
              </Link>
            ) : null}
          </div>
          <Card>
            <CardHeader>
              <CardTitle>Stack</CardTitle>
            </CardHeader>
            <CardContent className="flex flex-wrap gap-2">
              {project.stack.map((item) => (
                <Badge key={item} variant="secondary">
                  {item}
                </Badge>
              ))}
            </CardContent>
          </Card>
        </div>

        <section className="grid gap-4 lg:grid-cols-3">
          <Card>
            <CardHeader>
              <CardTitle>Challenge</CardTitle>
            </CardHeader>
            <CardContent className="flex flex-col gap-3 text-sm text-muted-foreground">
              {project.challenges.map((item) => (
                <p key={item}>{item}</p>
              ))}
            </CardContent>
          </Card>
          <Card>
            <CardHeader>
              <CardTitle>Feature</CardTitle>
            </CardHeader>
            <CardContent className="flex flex-col gap-3 text-sm text-muted-foreground">
              {project.features.map((item) => (
                <p key={item}>{item}</p>
              ))}
            </CardContent>
          </Card>
          <Card>
            <CardHeader>
              <CardTitle>Result</CardTitle>
            </CardHeader>
            <CardContent className="flex flex-col gap-3 text-sm text-muted-foreground">
              {project.results.map((item) => (
                <p key={item}>{item}</p>
              ))}
            </CardContent>
          </Card>
        </section>

        <section className="flex flex-col gap-5">
          <h2 className="text-2xl font-semibold tracking-tight">Detail project</h2>
          {project.detail.map((paragraph) => (
            <p key={paragraph} className="max-w-4xl leading-8 text-foreground/90">
              {paragraph}
            </p>
          ))}
        </section>
      </main>
      <MarketingFooter />
    </div>
  );
}
