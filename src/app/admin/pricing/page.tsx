import { Plus } from "lucide-react";
import { DataTable } from "@/components/admin/data-table";
import { PageHeading } from "@/components/admin/page-heading";
import { StatusBadge } from "@/components/admin/status-badge";
import { Button } from "@/components/ui/button";
import { pricingPlans } from "@/services/cms";

export default function AdminPricingPage() {
  return (
    <div className="flex flex-col gap-6">
      <PageHeading
        title="Pricing management"
        description="Publish offer packaging without touching application code."
        action={
          <Button size="sm">
            <Plus data-icon="inline-start" />
            New plan
          </Button>
        }
      />
      <DataTable
        title="Plans"
        columns={["Name", "Price", "Status", "Conversion"]}
        rows={pricingPlans.map((plan) => [
          plan.name,
          plan.price,
          <StatusBadge key={plan.name} status={plan.status} />,
          plan.conversions,
        ])}
      />
    </div>
  );
}
