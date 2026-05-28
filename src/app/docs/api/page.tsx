import type { Metadata } from "next";
import { MarketingFooter } from "@/components/marketing/footer";
import { MarketingHeader } from "@/components/marketing/header";
import { Badge } from "@/components/ui/badge";
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
import { Separator } from "@/components/ui/separator";
import { apiEndpoints } from "@/services/cms";

export const metadata: Metadata = {
  title: "API Docs",
  description: "API reference for content, leads, pricing, and WhatsApp webhook integrations.",
};

export default function ApiDocsPage() {
  return (
    <div className="min-h-screen bg-background">
      <MarketingHeader />
      <main className="mx-auto grid max-w-6xl gap-8 px-4 py-14 md:grid-cols-[0.7fr_1.3fr]">
        <div className="flex flex-col gap-3">
          <h1 className="text-4xl font-semibold tracking-tight">API docs</h1>
          <p className="leading-7 text-muted-foreground">
            Document public and internal endpoints before they are exposed behind a reverse proxy.
          </p>
        </div>
        <Card>
          <CardHeader>
            <CardTitle>Endpoints</CardTitle>
          </CardHeader>
          <CardContent className="flex flex-col gap-0">
            {apiEndpoints.map((endpoint, index) => (
              <div key={endpoint.path}>
                <div className="grid gap-3 py-4 md:grid-cols-[90px_1fr_1.4fr] md:items-center">
                  <Badge variant="outline">{endpoint.method}</Badge>
                  <code className="text-sm">{endpoint.path}</code>
                  <p className="text-sm text-muted-foreground">{endpoint.purpose}</p>
                </div>
                {index < apiEndpoints.length - 1 ? <Separator /> : null}
              </div>
            ))}
          </CardContent>
        </Card>
      </main>
      <MarketingFooter />
    </div>
  );
}
