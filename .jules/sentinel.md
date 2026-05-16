## 2026-05-16 - [SQL Injection Vulnerability in Cobrancas_model.php]
**Vulnerability:** SQL Injection via $id in getByOs and getByVendas methods in Cobrancas_model.php.
**Learning:** The $id was not properly escaped before being used in the raw query in Cobrancas_model.php
**Prevention:** Utilize prepared statements/parameter binding via CodeIgniter's $this->db->query with an array of variables, as opposed to string concatenation.
