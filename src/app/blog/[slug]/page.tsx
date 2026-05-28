import type { Metadata } from "next";
import { notFound } from "next/navigation";
import { MarketingFooter } from "@/components/marketing/footer";
import { MarketingHeader } from "@/components/marketing/header";
import { Badge } from "@/components/ui/badge";
import { getPublicBlogPostBySlug, getPublishedBlogSlugs } from "@/services/cms";

type BlogDetailPageProps = {
  params: Promise<{
    slug: string;
  }>;
};

export async function generateStaticParams() {
  return getPublishedBlogSlugs().map((slug) => ({ slug }));
}

export async function generateMetadata({ params }: BlogDetailPageProps): Promise<Metadata> {
  const { slug } = await params;
  const post = getPublicBlogPostBySlug(slug);

  if (!post) {
    return {
      title: "Blog",
    };
  }

  return {
    title: post.title,
    description: post.seoDescription,
  };
}

export default async function BlogDetailPage({ params }: BlogDetailPageProps) {
  const { slug } = await params;
  const post = getPublicBlogPostBySlug(slug);

  if (!post) {
    notFound();
  }

  return (
    <div className="min-h-screen bg-background">
      <MarketingHeader />
      <main className="mx-auto flex max-w-3xl flex-col gap-8 px-4 py-14">
        <div className="flex flex-col gap-4">
          <Badge variant="outline" className="w-fit">
            {post.category}
          </Badge>
          <h1 className="text-4xl font-semibold tracking-tight">{post.title}</h1>
          <p className="text-lg leading-8 text-muted-foreground">{post.excerpt}</p>
          <div className="flex flex-wrap gap-4 text-sm text-muted-foreground">
            <span>{post.author}</span>
            <span>{post.updatedAt}</span>
            <span>{post.readingTime}</span>
            <span>{post.views}</span>
          </div>
        </div>
        <article className="flex flex-col gap-5">
          {post.content.map((paragraph) => (
            <p key={paragraph} className="leading-8 text-foreground/90">
              {paragraph}
            </p>
          ))}
        </article>
      </main>
      <MarketingFooter />
    </div>
  );
}
