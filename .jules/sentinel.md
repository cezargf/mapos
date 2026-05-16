## 2024-05-16 - Removed N+1 DB Queries from Views
**Vulnerability:** Views in MapOS were executing database queries in a loop, causing an N+1 query vulnerability that severely degraded performance. Specifically, `isEditable` model methods calling `getById` were being used on each row rendered in the view.
**Learning:** Performance issues in MVC architectures frequently result from failing to eager load data or from checking authorization directly on each row in the view via database lookup instead of computing properties in memory.
**Prevention:** Data required for conditional rendering must be fetched fully via JOIN or bulk evaluation in the controller. Avoid calling model functions that trigger SQL queries inside view iteration blocks.
