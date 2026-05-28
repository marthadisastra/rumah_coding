import { MessageCircle, PlugZap, Smartphone } from "lucide-react";
import { PageHeading } from "@/components/admin/page-heading";
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";

const cards = [
  { title: "Connected numbers", value: "5", detail: "2 pending reconnect", icon: Smartphone },
  { title: "Messages today", value: "1,284", detail: "84% automated triage", icon: MessageCircle },
  { title: "Gateway health", value: "Online", detail: "Provider heartbeat healthy", icon: PlugZap },
];

export default function AdminWhatsAppPage() {
  return (
    <div className="flex flex-col gap-6">
      <PageHeading
        title="WhatsApp gateway"
        description="Monitor account sessions, delivery health, and operational routing."
      />
      <div className="grid gap-4 md:grid-cols-3">
        {cards.map((card) => (
          <Card key={card.title}>
            <CardHeader>
              <card.icon className="text-muted-foreground" />
              <CardTitle>{card.title}</CardTitle>
            </CardHeader>
            <CardContent>
              <p className="text-2xl font-semibold">{card.value}</p>
              <p className="text-sm text-muted-foreground">{card.detail}</p>
            </CardContent>
          </Card>
        ))}
      </div>
    </div>
  );
}
