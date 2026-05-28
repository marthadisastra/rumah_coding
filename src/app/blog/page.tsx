import type { Metadata } from "next";
import Link from "next/link";
import { MarketingFooter } from "@/components/marketing/footer";
import { MarketingHeader } from "@/components/marketing/header";
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from "@/components/ui/card";
import { publicBlogPosts } from "@/services/cms";

export const metadata: Metadata = {
  title: "Blog",
  description: "Operational notes and education growth articles from Rumah Coding.",
};

export default function BlogPage() {
  return (
    <div className="min-h-screen bg-background">
      <MarketingHeader />
      <main className="mx-auto flex max-w-6xl flex-col gap-8 px-4 py-14">
        <div className="flex max-w-2xl flex-col gap-3">
          <h1 className="text-4xl font-semibold tracking-tight">Blog</h1>
          <p className="leading-7 text-muted-foreground">
            CMS-backed content architecture for publishing technical education, enrollment, and
            operations notes.
          </p>
        </div>
        <div className="grid gap-4 md:grid-cols-3">
          {publicBlogPosts.map((post) => (
            <Card key={post.slug}>
              <CardHeader>
                <CardTitle className="leading-7">
                  <Link href={`/blog/${post.slug}`}>{post.title}</Link>
                </CardTitle>
                <CardDescription>{post.updatedAt}</CardDescription>
              </CardHeader>
              <CardContent className="text-sm text-muted-foreground">
                <p>{post.status} by {post.author}</p>
                <p className="mt-3 leading-6">{post.excerpt}</p>
              </CardContent>
            </Card>
          ))}
        </div>
      </main>
      <MarketingFooter />
    </div>
  );
}
