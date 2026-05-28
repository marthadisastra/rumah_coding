import { Activity, ArrowUpRight, Database, ShieldCheck } from "lucide-react";
import { DataTable } from "@/components/admin/data-table";
import { PageHeading } from "@/components/admin/page-heading";
import { StatusBadge } from "@/components/admin/status-badge";
import { Button } from "@/components/ui/button";
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
import { dashboardStats, leads, webhookLogs } from "@/services/cms";

export default function AdminPage() {
  return (
    <div className="flex flex-col gap-6">
      <PageHeading
        title="Overview"
        description="Operational snapshot for CMS publishing, lead intake, WhatsApp sessions, and API events."
        action={
          <Button size="sm">
            Export report
            <ArrowUpRight data-icon="inline-end" />
          </Button>
        }
      />
      <div className="grid gap-4 md:grid-cols-4">
        {dashboardStats.map((stat) => (
          <Card key={stat.label}>
            <CardHeader className="pb-3">
              <CardTitle className="text-sm font-medium text-muted-foreground">{stat.label}</CardTitle>
            </CardHeader>
            <CardContent>
              <p className="text-2xl font-semibold">{stat.value}</p>
              <p className="text-sm text-muted-foreground">{stat.change}</p>
            </CardContent>
          </Card>
        ))}
      </div>
      <div className="grid gap-4 md:grid-cols-3">
        {[
          { title: "Database", detail: "Prisma schema ready", icon: Database },
          { title: "Access", detail: "Role gates in admin routes", icon: ShieldCheck },
          { title: "Events", detail: "Webhook log model prepared", icon: Activity },
        ].map((item) => (
          <Card key={item.title}>
            <CardHeader>
              <item.icon className="text-muted-foreground" />
              <CardTitle>{item.title}</CardTitle>
            </CardHeader>
            <CardContent className="text-sm text-muted-foreground">{item.detail}</CardContent>
          </Card>
        ))}
      </div>
      <DataTable
        title="Recent leads"
        columns={["Name", "Company", "Source", "Status", "Created"]}
        rows={leads.map((lead) => [
          lead.name,
          lead.company,
          lead.channel,
          <StatusBadge key={lead.name} status={lead.status} />,
          lead.createdAt,
        ])}
      />
      <DataTable
        title="Recent webhooks"
        columns={["Event", "Source", "Status", "Created"]}
        rows={webhookLogs.map((log) => [log.event, log.source, log.statusCode, log.createdAt])}
      />
    </div>
  );
}
