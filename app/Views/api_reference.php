<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Documentation - Rumah Coding</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;700&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #ffffff; color: #0f172a; margin: 0; padding: 0; }
        .sidebar { background-color: #f8fafc; border-right: 1px solid #e2e8f0; height: 100vh; position: fixed; top: 0; padding-top: 2rem; width: 280px; overflow-y: auto; }
        .main-content { margin-left: 280px; padding: 3rem 4rem 100px; max-width: 1000px; }
        .sidebar-brand { font-weight: 700; font-size: 1.15rem; color: #0f172a; text-decoration: none; display: flex; align-items: center; margin-bottom: 2.5rem; padding: 0 1.5rem; letter-spacing: -0.02em; }
        .nav-category { font-size: 0.75rem; text-transform: uppercase; font-weight: 700; color: #64748b; margin: 1.5rem 1.5rem 0.5rem; letter-spacing: 0.05em; }
        .nav-link { color: #334155; font-size: 0.9rem; padding: 0.35rem 1.5rem; border-left: 3px solid transparent; font-weight: 500; }
        .nav-link:hover { color: #0f172a; background-color: #f1f5f9; }
        .nav-link.active { border-left-color: #2563eb; color: #2563eb; background-color: #eff6ff; }
        
        .code-block { background-color: #0f172a; border-radius: 8px; padding: 1.25rem; font-family: 'JetBrains Mono', monospace; font-size: 0.85rem; color: #f8fafc; overflow-x: auto; margin-bottom: 1.5rem; border: 1px solid #e2e8f0; box-shadow: inset 0 2px 4px rgba(0,0,0,0.2); }
        .code-property { color: #38bdf8; }
        .code-string { color: #a7f3d0; }
        .code-json { color: #facc15; }
        
        .endpoint { display: flex; align-items: center; margin-bottom: 1.25rem; border-bottom: 1px solid #e2e8f0; padding-bottom: 0.75rem; }
        .method { font-size: 0.75rem; font-weight: 700; padding: 0.2rem 0.5rem; border-radius: 4px; margin-right: 12px; font-family: 'JetBrains Mono', monospace; letter-spacing: 0.05em; }
        .method.post { background-color: #dbeafe; color: #0369a1; border: 1px solid #bfdbfe; }
        .method.get { background-color: #d1fae5; color: #047857; border: 1px solid #a7f3d0; }
        .path { font-family: 'JetBrains Mono', monospace; font-size: 0.95rem; font-weight: 500; color: #1e293b; }
        
        h1 { font-weight: 800; font-size: 2.25rem; letter-spacing: -0.03em; margin-bottom: 1rem; border-bottom: 1px solid #e2e8f0; padding-bottom: 1.5rem; }
        h2 { font-weight: 700; font-size: 1.5rem; margin-top: 3.5rem; margin-bottom: 1rem; letter-spacing: -0.02em; }
        h3 { font-weight: 600; font-size: 1.1rem; margin-top: 2rem; margin-bottom: 0.5rem; }
        p { font-size: 0.95rem; color: #475569; line-height: 1.7; }
        
        .table { font-size: 0.875rem; margin-bottom: 0; }
        .table th { background-color: #f8fafc; font-weight: 600; color: #64748b; text-transform: uppercase; font-size: 0.75rem; border-bottom: 1px solid #e2e8f0; padding: 12px 16px; letter-spacing: 0.05em; }
        .table td { padding: 12px 16px; border-bottom: 1px solid #e2e8f0; vertical-align: top; color: #334155; }
        .req { color: #dc2626; font-size: 0.7rem; font-weight: 600; text-transform: uppercase; padding: 2px 6px; background: #fee2e2; border-radius: 4px; margin-left: 6px;}
        code.inline { padding: 0.2em 0.4em; border-radius: 4px; background-color: #f1f5f9; font-family: 'JetBrains Mono', monospace; font-size: 0.8em; color: #0f172a; border: 1px solid #e2e8f0; }

        .back-link { position: absolute; bottom: 20px; left: 1.5rem; text-decoration: none; color: #64748b; font-size: 0.85rem; font-weight: 500; display: flex; align-items: center;}
        .back-link:hover { color: #0f172a; }
    </style>
</head>
<body>

    <!-- Sidebar Documentation Navigation -->
    <nav class="sidebar">
        <a href="/" class="sidebar-brand">
            <img src="<?= base_url('assets/images/logo.png') ?>" alt="Rumah Coding" height="24" class="me-2">
            API Documentation
        </a>
        
        <div class="nav-category">Core Engine</div>
        <a href="#authentication" class="nav-link">Authentication Header</a>
        <a href="#instances" class="nav-link">Create Remote Instance</a>
        
        <div class="nav-category">Messaging Dispatch</div>
        <a href="#send-text" class="nav-link active">Dispatch Text Notice</a>
        <a href="#send-media" class="nav-link">Dispatch Media / PDF</a>
        
        <div class="nav-category">Webhooks</div>
        <a href="#events" class="nav-link">Event Mapping</a>

        <a href="/" class="back-link"><i class="bi bi-arrow-left me-2"></i> Back to Main Site</a>
    </nav>

    <!-- Content Documentation -->
    <main class="main-content">
        <h1>Gateway Reference API</h1>
        <p>The Rumah Coding Gateway API framework delegates endpoints to control and orchestrate the underlying headless nodes. Organized through standard RESTful methodology utilizing JSON structural inputs, the system ensures programmatic routing of WhatsApp protocol integration cleanly devoid of state complexities.</p>

        <h2 id="authentication">Authentication Protocol</h2>
        <p>Endpoint authorization dictates a master API signature inside the header logic. Tokens strictly reside on your private panel infrastructure ensuring the secure linkage of outgoing requests.</p>
        <div class="code-block" style="background:#ffffff; color:#0f172a;">
            <span style="color:#94a3b8">// HTTP Headers Required</span><br>
            <span style="font-weight:700;">apikey:</span> YOUR_GLOBAL_TENANT_API_KEY<br>
            <span style="font-weight:700;">Content-Type:</span> application/json
        </div>

        <h2 id="instances">Binding Node Instance</h2>
        <p>Commands the engine container to allocate a fresh UUID session, yielding an executable WebSocket connection ready to transmit authorization frames (QR code).</p>
        <div class="endpoint">
            <span class="method post">POST</span>
            <span class="path">/instance/create</span>
        </div>
        
        <div class="row align-items-center">
            <div class="col-lg-6">
                <table class="table mb-4 border rounded">
                    <thead>
                        <tr>
                            <th>JSON Key</th>
                            <th>Definitions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><code class="inline">instanceName</code> <span class="req">Required</span></td>
                            <td>Unique deterministic node name. Alphabets or underscored permitted.</td>
                        </tr>
                        <tr>
                            <td><code class="inline">qrcode</code></td>
                            <td>Force returns a Base64-formatted QR schema string buffer output for clients to scan. Expected value: <code class="inline">true</code>.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-6">
                <div class="code-block mb-4 h-100">
<span style="color:#64748b">// Structure Request Layout</span>
{
    <span class="code-property">"instanceName"</span>: <span class="code-string">"CS_HQ_NODE1"</span>,
    <span class="code-property">"token"</span>: <span class="code-string">"CLIENT_ID_SECURE_PHRASE"</span>,
    <span class="code-property">"qrcode"</span>: <span class="code-json">true</span>
}
                </div>
            </div>
        </div>

        <h2 id="send-text">Dispatching Text Payload</h2>
        <p>Executes an atomic synchronous send operation targeting a distinct peer-to-peer or multiplex group network.</p>
        
        <div class="endpoint">
            <span class="method post">POST</span>
            <span class="path">/message/sendText/{instanceName}</span>
        </div>

        <div class="row">
            <div class="col-lg-12 mb-4">
                <table class="table border rounded">
                    <thead>
                        <tr>
                            <th style="width:25%;">JSON Pattern Payload</th>
                            <th>Description and Execution Constraint</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><code class="inline">number</code> <span class="req">Required</span></td>
                            <td>Phone address node encoded strictly starting with numeric nation code representing the remote JID sequence (e.g. <code class="inline">6281...</code>). Group broadcasts utilize the <code class="inline">@g.us</code> appendage indicator.</td>
                        </tr>
                        <tr>
                            <td><code class="inline">options.delay</code></td>
                            <td>Millisecond timing parameter mitigating API throttling constraints naturally. Generates typing state emulation prior to dispatch.</td>
                        </tr>
                        <tr>
                            <td><code class="inline">textMessage.text</code> <span class="req">Required</span></td>
                            <td>Unicode string variables encompassing the transmission packet. Compatible with WhatsApp specific markdown styling (asterisks, tildes).</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-12">
                <div class="code-block">
<span style="color:#64748b">// Standard Blast Array Payload Reference Structure</span>
{
    <span class="code-property">"number"</span>: <span class="code-string">"6281234567890"</span>,
    <span class="code-property">"options"</span>: {
        <span class="code-property">"delay"</span>: <span class="code-json">1200</span>,
        <span class="code-property">"presence"</span>: <span class="code-string">"composing"</span>
    },
    <span class="code-property">"textMessage"</span>: {
        <span class="code-property">"text"</span>: <span class="code-string">"Greetings from the reliable *B2B Gateway API*! \nThis payload is constructed automatically via Node Integration."</span>
    }
}
                </div>
            </div>
        </div>

        <p class="mt-5 text-center text-muted" style="font-size: 0.8rem;">To harness the full suite of documentation (Webhooks structure mappings, Multi-Media processing), please enroll towards the workspace Dashboard.</p>
    </main>

    <!-- Bootstrap Script (Minimal Use) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
