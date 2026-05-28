export type Status = "Draft" | "Published" | "Archived";

export type BlogSummary = {
  title: string;
  slug: string;
  status: Status;
  author: string;
  updatedAt: string;
  views: string;
  excerpt?: string;
};

export type BlogPostDetail = {
  title: string;
  slug: string;
  status: Status;
  author: string;
  updatedAt: string;
  views: string;
  excerpt: string;
  readingTime: string;
  category: string;
  seoDescription: string;
  content: string[];
};

export type FaqSummary = {
  question: string;
  category: string;
  status: Status;
};

export type PricingSummary = {
  name: string;
  price: string;
  status: Status;
  conversions: string;
};

export type PortfolioSummary = {
  name: string;
  slug: string;
  category: string;
  year: string;
  status: Status;
  summary: string;
  stack: string[];
};

export type PortfolioDetail = {
  name: string;
  slug: string;
  category: string;
  year: string;
  status: Status;
  summary: string;
  headline: string;
  client: string;
  website?: string;
  stack: string[];
  challenges: string[];
  features: string[];
  results: string[];
  detail: string[];
};

export type LeadSummary = {
  name: string;
  company: string;
  channel: string;
  status: "New" | "Contacted" | "Qualified" | "Won" | "Lost";
  createdAt: string;
};

export type WebhookSummary = {
  event: string;
  source: string;
  statusCode: number;
  createdAt: string;
};
