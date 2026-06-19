<?php

class LinkCard
{
    private string $url;
    private string $title;
    private string $description;
    private string $domain;

    public function __construct(string $url, string $title, string $description = '')
    {
        $this->url = $url;
        $this->title = $title;
        $this->description = $description;
        $this->domain = parse_url($url, PHP_URL_HOST) ?: '';
    }

    public function render(): string
    {
        $escapedUrl = htmlspecialchars($this->url, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedTitle = htmlspecialchars($this->title, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedDesc = htmlspecialchars($this->description, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedDomain = htmlspecialchars($this->domain, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        $html = <<<HTML
<div class="link-card">
    <a href="{$escapedUrl}" target="_blank" rel="noopener noreferrer" class="link-card-anchor">
        <div class="link-card-content">
            <span class="link-card-domain">{$escapedDomain}</span>
            <h3 class="link-card-title">{$escapedTitle}</h3>
            <p class="link-card-description">{$escapedDesc}</p>
        </div>
        <div class="link-card-indicator">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M7 17L17 7M17 7H7M17 7V17"/>
            </svg>
        </div>
    </a>
</div>
HTML;

        return $html;
    }

    public static function createDefaultCard(): self
    {
        return new self(
            'https://cns-webs-hth.com',
            'HTH Resource Hub',
            'Discover tools and insights for the hth community — curated references and practical guides.'
        );
    }
}

function render_link_card(string $url, string $title, string $description = ''): string
{
    $card = new LinkCard($url, $title, $description);
    return $card->render();
}