# BCB System Architecture — How and Why This Works

> A guide for humans and AI systems to understand the Bootstrap Component Blox (BCB) manifest-driven development system.

---

## 1. What This System Is

BCB is a **WordPress parent theme** paired with a **documentation-driven development system** that enables AI agents (or any developer) to build production-quality child themes in a consistent, predictable style — without needing to study the codebase from scratch every time.

The system replaces tribal knowledge with structured reference files. Instead of an agent guessing at conventions, reading scattered code comments, or asking repeated questions, it reads a set of manifest files that define exactly how to build.

---

## 2. The Problem It Solves

AI agents are capable coders, but they lack persistent memory of a project's conventions. Every new session starts cold. Without guidance, an agent will:

- Invent its own class naming conventions
- Write CSS in the wrong file
- Skip escaping or use the wrong escaping function
- Ignore responsive patterns
- Produce code that works but doesn't match the project's style

Fixing these inconsistencies costs more time than building from scratch. The BCB system solves this by giving the agent a **complete, authoritative reference** before it writes a single line of code.

---

## 3. System Components

The system has four components, each with a distinct role:

```
┌─────────────────────────────────────────────────────────┐
│                    SKILL FILE                           │
│         (~/.claude/skills/bcb-mode/SKILL.md)            │
│                                                         │
│  Agent behavior rules, loading order, safety overrides  │
│  "How to behave" — the conductor                        │
└────────────────────────┬────────────────────────────────┘
                         │ instructs the agent to load
            ┌────────────┴────────────┐
            ▼                         ▼
┌──────────────────────┐  ┌──────────────────────┐
│   CORE MANIFEST      │  │  PROJECT MANIFEST    │
│  (bcb-manifest-      │  │  (project-           │
│   core.md)           │  │   manifest.md)       │
│                      │  │                      │
│  Helper signatures,  │  │  CSS prefix, colors, │
│  file structure,     │  │  fonts, buttons,     │
│  section pattern,    │  │  image IDs, page     │
│  CSS rules,          │  │  templates, design   │
│  responsive rules,   │  │  tokens, component   │
│  safety constraints  │  │  patterns            │
│                      │  │                      │
│  "How to build"      │  │  "What to build with"│
│  ~6KB, always loaded │  │  Always loaded       │
└──────────┬───────────┘  └──────────────────────┘
           │ expanded by (on demand)
           ▼
┌──────────────────────┐
│   FULL MANIFEST      │
│  (bcb-manifest.md)   │
│                      │
│  Complete code        │
│  examples, CPT        │
│  patterns, Swiper/    │
│  GSAP boilerplate,    │
│  Customizer settings, │
│  widget areas         │
│                      │
│  "How to build        │
│   (with examples)"   │
│  ~19KB, on demand    │
└──────────────────────┘
```

### Why Three Manifests Instead of One?

Context efficiency. AI agents have limited context windows. Loading 19KB of documentation for a CSS tweak wastes capacity that could be used for reasoning about the actual task. The tiered approach loads only what's needed:

| Task complexity | Files loaded | Context cost |
|---|---|---|
| CSS fix, copy change, bug fix | Core + Project | ~9KB |
| Build a new page section | Core + Project + Full | ~28KB |

---

## 4. How the Pieces Work Together

### Step 1: Activation

The skill file (`SKILL.md`) activates whenever an agent enters a directory containing a `project-manifest.md` that references `bootstrap-component-blox`. It acts as the entry point — the agent reads it first and follows its instructions.

### Step 2: Pre-Flight Check

Before any work, the agent:
1. Locates and reads `bcb-manifest-core.md` from the parent theme directory
2. Locates and reads `project-manifest.md` from the child theme directory
3. Determines if the task requires loading the full `bcb-manifest.md`

If `project-manifest.md` is missing, the agent scaffolds one by scanning the child theme's existing code (extracting CSS variables, class names, font declarations, template registrations) and asks the operator to confirm anything it can't derive.

### Step 3: Build

The agent now has everything it needs:
- **What conventions to follow** (core manifest)
- **What colors, fonts, and prefix to use** (project manifest)
- **What code patterns to apply** (full manifest, if loaded)
- **What safety rules to enforce** (skill file)

Every decision — file naming, class naming, escaping, responsive breakpoints, CSS file placement — is defined in the manifests. The agent doesn't need to guess.

### Step 4: Sync

After completing a page or view, the agent updates `project-manifest.md` with any new image IDs, templates, component classes, or utility classes introduced during the build. This keeps the project manifest current for the next session.

---

## 5. Design Principles

These principles explain *why* the system is structured this way, not just *how*.

### Convention Over Configuration

The system defines strong defaults for everything — file naming, section structure, CSS scoping, responsive patterns, escaping rules. An agent following the manifests will produce code that looks like every other page in the project without being told to "match the existing style."

### Scoped CSS

Every page gets its own CSS file (`css/{context}.css`), conditionally enqueued only on that page. This prevents regression — changing styles for one page can't break another. The global `style.css` holds only shared variables, utilities, and base styles, and is treated as read-only by the agent.

### Orchestrator Templates

Page templates contain zero markup. They only call `get_template_part()`. All HTML lives in template parts under `template-parts/{context}/`. This separates page structure (what sections appear and in what order) from section implementation (the actual markup).

### Safety by Default

Escaping rules are defined in the skill file and override any abbreviated examples in the manifests. The agent always escapes output — `esc_url()` for URLs, `esc_html()` for text, `esc_attr()` for attributes. Shortcode output uses `do_shortcode()` directly without `wp_kses_post()` wrapping (which breaks form elements from plugins like WPForms).

### Read-Only Globals

The agent reads `style.css` to discover reusable classes but never writes to it unless explicitly permitted by the operator. This prevents agents from polluting shared styles with page-specific CSS.

---

## 6. For Other Systems: Integration Points

If another AI system, development tool, or workflow needs to interface with BCB projects, here's what matters:

### Reading a BCB Project

1. Check for `project-manifest.md` in the child theme — it contains the project's CSS prefix, color palette, typography, and all project-specific configuration
2. Check for `bcb-manifest-core.md` in the parent theme — it defines the framework's API (helper functions, hooks, file structure)
3. The CSS prefix (e.g. `gec-`, `tc-`) is the namespace for all custom classes, variables, and section IDs

### Contributing to a BCB Project

Any system generating code for a BCB project should:
- Use the project's CSS prefix for all custom classes and IDs
- Place page-specific CSS in `css/{context}.css`, not in `style.css`
- Use `bcb_image_url()` / `bcb_image_alt()` for media references
- Follow the section template pattern: `<section id="{prefix}-{name}">` → `container` → `row` → columns
- Apply responsive pairs: `g-4 g-lg-5`, `mb-4 mb-lg-5` — never desktop-only values
- Escape all output per WordPress conventions

### Adapting This Approach for Another Framework

The BCB system is WordPress-specific, but the architecture pattern is framework-agnostic:

1. **Create a core reference** — a compact file listing your framework's API surface (function signatures, conventions, constraints). Keep it small enough to always load.
2. **Create a full reference** — complete code examples and integration patterns. Load only when building.
3. **Create a project config** — per-project values (colors, fonts, naming prefix, component registry). Always load.
4. **Create a skill/behavior file** — agent rules, loading order, safety constraints, verification workflow. This is the entry point.
5. **Define strong conventions** — file naming, CSS scoping, component structure, escaping rules. The more decisions you pre-make, the less the agent invents.
6. **Tier the loading** — small tasks get small context. Big tasks get full context. Don't waste the agent's reasoning capacity on documentation it doesn't need.

The key insight: **documentation isn't for the agent to learn your framework — it's for the agent to learn your decisions.** The framework docs tell it what's possible. Your manifests tell it what you chose.

---

## 7. File Locations

```
Parent theme repo (componentblox/bootstrap-component-blox):
├── style.css                    ← Theme header with version (Puc checks this)
├── bcb-manifest-core.md         ← Compact API reference (always loaded)
├── bcb-manifest.md              ← Full API reference (loaded on demand)
├── llms.txt                     ← Public-facing overview for AI discovery
└── SYSTEM.md                    ← This file

Child theme starter repo (componentblox/bootstrap-component-blox-child-theme):
├── style.css                    ← Starter CSS with placeholders
├── project-manifest.md          ← Project config template
└── llms.txt                     ← Child theme overview for AI discovery

Skill file (local to the operator's machine):
└── ~/.claude/skills/bcb-mode/SKILL.md  ← Agent behavior rules
```

---

## 8. Version History

| Version | Date | Changes |
|---|---|---|
| 2.8.0 | — | Security hardening, SVG upload removal, icon refactor, GitHub release workflow |
| 2.8.1 | — | Manifest corrections and convention updates |
| 2.8.2 | — | Fix Parsedown fatal error in update checker |
| 2.8.3 | — | Fix release ZIP structure for WordPress updates |
| 2.8.4 | 2026-04-12 | Added `bcb-manifest-core.md`, tiered loading, removed max-width utilities, fixed cross-file inconsistencies |
| 2.8.5 | 2026-04-13 | Moved Design Token Map and Component Patterns from project-manifest to bcb-manifest, eliminated redundant version strings (single source of truth in style.css), slimmed project-manifest to project-only config |
