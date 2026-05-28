import { Plus } from "lucide-react";
import { DataTable } from "@/components/admin/data-table";
import { PageHeading } from "@/components/admin/page-heading";
import { StatusBadge } from "@/components/admin/status-badge";
import { Button } from "@/components/ui/button";
import { blogPosts } from "@/services/cms";

export default function AdminBlogPage() {
  return (
    <div className="flex flex-col gap-6">
      <PageHeading
        title="Blog management"
        description="Create, review, publish, and archive SEO-focused content."
        action={
          <Button size="sm">
            <Plus data-icon="inline-start" />
            New post
          </Button>
        }
      />
      <DataTable
        title="Posts"
        columns={["Title", "Slug", "Status", "Author", "Updated", "Views"]}
        rows={blogPosts.map((post) => [
          post.title,
          post.slug,
          <StatusBadge key={post.slug} status={post.status} />,
          post.author,
          post.updatedAt,
          post.views,
        ])}
      />
    </div>
  );
}
