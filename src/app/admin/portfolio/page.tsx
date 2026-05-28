import { Plus } from "lucide-react";
import { DataTable } from "@/components/admin/data-table";
import { PageHeading } from "@/components/admin/page-heading";
import { StatusBadge } from "@/components/admin/status-badge";
import { Button } from "@/components/ui/button";
import { portfolioSummaries } from "@/services/cms";

export default function AdminPortfolioPage() {
  return (
    <div className="flex flex-col gap-6">
      <PageHeading
        title="Portfolio management"
        description="Kelola daftar software, studi kasus, dan detail teknis yang tampil di halaman portfolio publik."
        action={
          <Button size="sm">
            <Plus data-icon="inline-start" />
            New project
          </Button>
        }
      />
      <DataTable
        title="Projects"
        columns={["Project", "Category", "Year", "Status", "Stack"]}
        rows={portfolioSummaries.map((project) => [
          project.name,
          project.category,
          project.year,
          <StatusBadge key={project.slug} status={project.status} />,
          project.stack.join(", "),
        ])}
      />
    </div>
  );
}
