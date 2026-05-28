import { Plus } from "lucide-react";
import { DataTable } from "@/components/admin/data-table";
import { PageHeading } from "@/components/admin/page-heading";
import { StatusBadge } from "@/components/admin/status-badge";
import { Button } from "@/components/ui/button";
import { faqs } from "@/services/cms";

export default function AdminFaqsPage() {
  return (
    <div className="flex flex-col gap-6">
      <PageHeading
        title="FAQ management"
        description="Maintain searchable support answers for marketing and enrollment pages."
        action={
          <Button size="sm">
            <Plus data-icon="inline-start" />
            New FAQ
          </Button>
        }
      />
      <DataTable
        title="FAQ items"
        columns={["Question", "Category", "Status"]}
        rows={faqs.map((faq) => [
          faq.question,
          faq.category,
          <StatusBadge key={faq.question} status={faq.status} />,
        ])}
      />
    </div>
  );
}
