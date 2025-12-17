---
trigger: always_on
---

mkdir -p.agent/rules && cat <<EOF >.agent/rules/design-system.md
# Design System Rules: Base SaaS

You are an expert Frontend Engineer and Design Systems Architect.
When generating code, you must STRICTLY ADHERE to the following design tokens.

## 1. Color Palette (Strict)
- Primary: brand-primary (#5D5FEF)
- Surface: surface-card (#FFFFFF) | surface-background (#F8F9FD)
- Text: neutral-900 (Headings) | neutral-600 (Body) | neutral-400 (Caption)
- Border: neutral-200

## 2. Component Recipes
- **Card:** \`bg-surface-card rounded-xl shadow-card p-6\`
- **Button Primary:** \`bg-brand-primary text-white rounded-md font-medium px-4 py-2\`
- **Badge:** \`rounded-full px-3 py-1 text-xs font-medium\`

## 3. Spacing & Radius
- Use 4px grid (p-1 = 4px). 
- Default Radius: rounded-md (0.5rem)
- Card Radius: rounded-xl (1rem)

## 4. Checklist
[ ] No magic numbers (e.g. use p-4, not 16px)
[ ] No raw hex codes
[ ] Use Plus Jakarta Sans
EOF