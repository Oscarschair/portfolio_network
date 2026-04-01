# Portfolio Network - Deployment Script (PowerShell)
# Encoding Fix
[Console]::OutputEncoding = [System.Text.Encoding]::UTF8
$OutputEncoding = [System.Text.Encoding]::UTF8

# 1. Load configuration from .env.deploy
if (-Not (Test-Path ".env.deploy")) {
    Write-Host "Error: .env.deploy not found." -ForegroundColor Red
    exit 1
}

$envDeploy = Get-Content ".env.deploy" -Encoding UTF8
$SSH_USER = ($envDeploy | Select-String "SSH_USER=").ToString().Split("=")[1].Trim()
$SSH_HOST = ($envDeploy | Select-String "SSH_HOST=").ToString().Split("=")[1].Trim()
$SSH_PORT = ($envDeploy | Select-String "SSH_PORT=").ToString().Split("=")[1].Trim()
$DEPLOY_DIR = ($envDeploy | Select-String "DEPLOY_DIR=").ToString().Split("=")[1].Trim()

Write-Host "--- Starting Deployment ---" -ForegroundColor Cyan

# 2. Push local changes to Git
Write-Host "[1/3] Pushing changes to git..." -ForegroundColor Yellow
git add .
$status = git status --porcelain
if ($status) {
    git commit -m ("Auto-deploy: " + (Get-Date -Format 'yyyy-MM-dd HH:mm:ss'))
}
git push origin main

# 3. Pull changes on the remote server
Write-Host "[2/3] Applying updates on remote server (Lolipop PHP8.4)..." -ForegroundColor Yellow
$connectionString = $SSH_USER + "@" + $SSH_HOST
Write-Host ("Connecting to: " + $connectionString + " -p " + $SSH_PORT) -ForegroundColor Gray

# Using php8.4 for Lolipop environment and forcing git update
$commandsToRun = 'mkdir -p ' + $DEPLOY_DIR + 'public/portfolioimages ; '
$commandsToRun += 'if [ -d ' + $DEPLOY_DIR + 'storage/app/portfolioicon ]; then mv ' + $DEPLOY_DIR + 'storage/app/portfolioicon/* ' + $DEPLOY_DIR + 'public/portfolioimages/ 2>/dev/null || true; fi ; '
$commandsToRun += 'cd ' + $DEPLOY_DIR + ' ; '
$commandsToRun += 'git fetch origin main ; '
$commandsToRun += 'git reset --hard origin/main ; '
$commandsToRun += 'php8.4 artisan migrate --force ; '
$commandsToRun += 'php8.4 artisan config:clear ; '
$commandsToRun += 'php8.4 artisan view:clear'

# Run Windows SSH command
ssh -p $SSH_PORT $connectionString $commandsToRun

if ($LASTEXITCODE -eq 0) {
    Write-Host "[3/3] Deployment completed successfully!" -ForegroundColor Green
}
else {
    Write-Host "Error: Remote command execution failed." -ForegroundColor Red
    exit $LASTEXITCODE
}
