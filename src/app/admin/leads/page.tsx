import { Download } from "lucide-react";
import { DataTable } from "@/components/admin/data-table";
import { PageHeading } from "@/components/admin/page-heading";
import { StatusBadge } from "@/components/admin/status-badge";
import { Button } from "@/components/ui/button";
import { leads } from "@/services/cms";

export default function AdminLeadsPage() {
  return (
    <div className="flex flex-col gap-6">
      <PageHeading
        title="Lead management"
        description="Track website, blog, and WhatsApp inquiries through a compact sales queue."
        action={
          <Button size="sm" variant="outline">
            <Download data-icon="inline-start" />
            CSV
          </Button>
        }
      />
      <DataTable
        title="Pipeline"
        columns={["Name", "Company", "Channel", "Status", "Created"]}
        rows={leads.map((lead) => [
          lead.name,
          lead.company,
          lead.channel,
          <StatusBadge key={lead.name} status={lead.status} />,
          lead.createdAt,
        ])}
      />
    </div>
  );
}
