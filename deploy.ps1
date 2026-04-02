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

Write-Host "--- Remote Update Only ---" -ForegroundColor Cyan
Write-Host "Note: Local push skipped (Perform manually if needed)" -ForegroundColor Gray

# 2. Update the remote server via SSH
Write-Host ("Updating remote server (PULL only)...") -ForegroundColor Yellow
$connectionString = $SSH_USER + "@" + $SSH_HOST
Write-Host ("Connecting to: " + $connectionString + " -p " + $SSH_PORT) -ForegroundColor Gray

# Simplified commands: CD to directory and Git Pull
$commandsToRun = "cd $DEPLOY_DIR && git pull origin main && php8.4 artisan migrate --force && " +
    "php8.4 artisan config:clear && php8.4 artisan view:clear"

# Run Windows SSH command
ssh -p $SSH_PORT $connectionString $commandsToRun

if ($LASTEXITCODE -eq 0) {
    Write-Host "Update completed successfully!" -ForegroundColor Green
}
else {
    Write-Host "Error: Remote update failed." -ForegroundColor Red
    exit $LASTEXITCODE
}

