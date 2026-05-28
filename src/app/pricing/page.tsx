import type { Metadata } from "next";
import { Check } from "lucide-react";
import { MarketingFooter } from "@/components/marketing/footer";
import { MarketingHeader } from "@/components/marketing/header";
import { Button } from "@/components/ui/button";
import { Card, CardContent, CardFooter, CardHeader, CardTitle } from "@/components/ui/card";
import { pricingPlans } from "@/services/cms";

export const metadata: Metadata = {
  title: "Pricing",
  description: "Training and platform packages for Rumah Coding customers.",
};

export default function PricingPage() {
  return (
    <div className="min-h-screen bg-background">
      <MarketingHeader />
      <main className="mx-auto flex max-w-6xl flex-col gap-8 px-4 py-14">
        <div className="flex max-w-2xl flex-col gap-3">
          <h1 className="text-4xl font-semibold tracking-tight">Pricing</h1>
          <p className="leading-7 text-muted-foreground">
            Pricing content is modeled in Prisma so marketing can evolve offers without changing
            route code.
          </p>
        </div>
        <div className="grid gap-4 md:grid-cols-3">
          {pricingPlans.map((plan) => (
            <Card key={plan.name}>
              <CardHeader>
                <CardTitle>{plan.name}</CardTitle>
                <p className="text-3xl font-semibold">{plan.price}</p>
              </CardHeader>
              <CardContent className="flex flex-col gap-3 text-sm text-muted-foreground">
                {["CMS-ready", "Lead tracking", "SEO metadata"].map((feature) => (
                  <span key={feature} className="flex items-center gap-2">
                    <Check />
                    {feature}
                  </span>
                ))}
              </CardContent>
              <CardFooter>
                <Button className="w-full">Request plan</Button>
              </CardFooter>
            </Card>
          ))}
        </div>
      </main>
      <MarketingFooter />
    </div>
  );
}
