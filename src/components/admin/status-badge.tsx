import { Badge } from "@/components/ui/badge";

const variantByStatus = {
  Published: "default",
  Draft: "secondary",
  Archived: "outline",
  New: "secondary",
  Contacted: "outline",
  Qualified: "default",
  Won: "default",
  Lost: "destructive",
} as const;

type Status = keyof typeof variantByStatus;

export function StatusBadge({ status }: { status: Status }) {
  return <Badge variant={variantByStatus[status]}>{status}</Badge>;
}
