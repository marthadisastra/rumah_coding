import { DataTable } from "@/components/admin/data-table";
import { PageHeading } from "@/components/admin/page-heading";
import { webhookLogs } from "@/services/cms";

export default function AdminWebhooksPage() {
  return (
    <div className="flex flex-col gap-6">
      <PageHeading
        title="Webhook logs"
        description="Inspect recent inbound and outbound events across website, WhatsApp, and billing systems."
      />
      <DataTable
        title="Events"
        columns={["Event", "Source", "Status code", "Created"]}
        rows={webhookLogs.map((log) => [log.event, log.source, log.statusCode, log.createdAt])}
      />
    </div>
  );
}
