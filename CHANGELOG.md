# Changes

## 2.9.0

- Add opt-in shared navigation, focus, component link and TranslatePress language presentation.
- Add a normally rendered, editable confirmation page while preserving legacy template behavior.
- Keep form and mail provisioning in the pipeline; no theme-activation data migrations.
- Validate PHP/JS and compatibility contracts before deterministic release packaging.
- Create draft releases by default, pending compatibility and production auto-update review.

Existing children do not opt in automatically. Adopt `bcb-ui-v1` after removing duplicate child
dropdown handlers and verifying brand tokens, header variants and confirmation pages.
