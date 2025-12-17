---
description: How to maintain and use the Design System
---

# Design System Guidelines

This project uses a custom design system based on `design_token.json`, implemented via Tailwind CSS.

## 1. Tailwind Configuration
The `tailwind.config.js` is the source of truth for all styles. Use Tailwind utility classes instead of inline styles or raw CSS whenever possible.

### Key Color Tokens:
- **Brand**: `brand-primary` (#5D5FEF), `brand-secondary` (#A5A6F6), `brand-muted` (#EEF2FF)
- **Neutral**: `neutral-50` to `neutral-900`
- **Surface**: `surface-background` (#F8F9FD), `surface-card` (#FFFFFF)
- **Semantic**: `semantic-success`, `semantic-warning`, `semantic-danger`, `semantic-info`

### Typography:
- **Font Family**: `font-sans` (Plus Jakarta Sans)
- **Font Weight**: `font-normal`, `font-medium`, `font-semibold`, `font-bold`

## 2. Component Best Practices
- **Cards**: Use `bg-surface-card rounded-xl shadow-card`.
- **Inputs**: Use `bg-neutral-50 border border-neutral-100 rounded-lg`.
- **Buttons**:
  - Primary: `bg-brand-primary text-white rounded-lg`.
  - Ghost: `bg-transparent text-neutral-500 hover:bg-neutral-100`.

## 3. Updating Tokens
If `design_token.json` is updated:
1. Reflect changes in `tailwind.config.js`.
2. Ensure `src/index.css` still aligns with core background/text tokens.

// turbo-all
