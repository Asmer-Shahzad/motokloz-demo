<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
  xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
  xmlns:sm="http://www.sitemaps.org/schemas/sitemap/0.9"
  exclude-result-prefixes="sm">

  <xsl:output method="html" encoding="UTF-8" indent="yes"/>

  <!-- ═══════════════════════════════════════════════════
       SITEMAP INDEX  (sitemapindex root element)
       ═══════════════════════════════════════════════════ -->
  <xsl:template match="/sm:sitemapindex">
    <html lang="en">
      <xsl:call-template name="head">
        <xsl:with-param name="title">Sitemap Index — Motokloz</xsl:with-param>
      </xsl:call-template>
      <body>
        <xsl:call-template name="header">
          <xsl:with-param name="heading">Sitemap Index</xsl:with-param>
          <xsl:with-param name="subheading">
            <xsl:value-of select="count(sm:sitemap)"/> sitemaps found
          </xsl:with-param>
        </xsl:call-template>

        <main>
          <table>
            <thead>
              <tr>
                <th>#</th>
                <th>Sitemap URL</th>
                <th>Last Modified</th>
              </tr>
            </thead>
            <tbody>
              <xsl:for-each select="sm:sitemap">
                <tr>
                  <td class="num"><xsl:value-of select="position()"/></td>
                  <td>
                    <a href="{sm:loc}"><xsl:value-of select="sm:loc"/></a>
                  </td>
                  <td class="meta"><xsl:value-of select="sm:lastmod"/></td>
                </tr>
              </xsl:for-each>
            </tbody>
          </table>
        </main>

        <xsl:call-template name="footer"/>
      </body>
    </html>
  </xsl:template>

  <!-- ═══════════════════════════════════════════════════
       URL SET  (urlset root element)
       ═══════════════════════════════════════════════════ -->
  <xsl:template match="/sm:urlset">
    <html lang="en">
      <xsl:call-template name="head">
        <xsl:with-param name="title">Sitemap — Motokloz</xsl:with-param>
      </xsl:call-template>
      <body>
        <xsl:call-template name="header">
          <xsl:with-param name="heading">Sitemap</xsl:with-param>
          <xsl:with-param name="subheading">
            <xsl:value-of select="count(sm:url)"/> URLs indexed
          </xsl:with-param>
        </xsl:call-template>

        <main>
          <xsl:call-template name="url-section">
            <xsl:with-param name="title">Static Pages</xsl:with-param>
            <xsl:with-param name="urls" select="sm:url[not(contains(sm:loc, '/dealer-profile/')) and not(contains(sm:loc, '/car-details/'))]"/>
          </xsl:call-template>

          <xsl:call-template name="url-section">
            <xsl:with-param name="title">Dealer Profiles</xsl:with-param>
            <xsl:with-param name="urls" select="sm:url[contains(sm:loc, '/dealer-profile/')]"/>
          </xsl:call-template>

          <xsl:call-template name="url-section">
            <xsl:with-param name="title">Inventory Details</xsl:with-param>
            <xsl:with-param name="urls" select="sm:url[contains(sm:loc, '/car-details/')]"/>
          </xsl:call-template>
        </main>

        <xsl:call-template name="footer"/>
      </body>
    </html>
  </xsl:template>

  <!-- ═══════════════════════════════════════════════════
       NAMED TEMPLATES
       ═══════════════════════════════════════════════════ -->
  <xsl:template name="url-section">
    <xsl:param name="title"/>
    <xsl:param name="urls"/>

    <section class="sitemap-section">
      <div class="section-heading">
        <h2><xsl:value-of select="$title"/></h2>
        <span><xsl:value-of select="count($urls)"/> URLs</span>
      </div>

      <table>
        <thead>
          <tr>
            <th>#</th>
            <th>URL</th>
            <th>Last Modified</th>
            <th>Change Freq</th>
            <th>Priority</th>
          </tr>
        </thead>
        <tbody>
          <xsl:for-each select="$urls">
            <tr>
              <td class="num"><xsl:value-of select="position()"/></td>
              <td>
                <a href="{sm:loc}"><xsl:value-of select="sm:loc"/></a>
              </td>
              <td class="meta"><xsl:value-of select="sm:lastmod"/></td>
              <td class="meta"><xsl:value-of select="sm:changefreq"/></td>
              <td class="priority">
                <xsl:call-template name="priority-badge">
                  <xsl:with-param name="val" select="sm:priority"/>
                </xsl:call-template>
              </td>
            </tr>
          </xsl:for-each>
        </tbody>
      </table>
    </section>
  </xsl:template>

  <xsl:template name="head">
    <xsl:param name="title"/>
    <head>
      <meta charset="UTF-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <meta name="robots" content="noindex, follow"/>
      <title><xsl:value-of select="$title"/></title>
      <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
          font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
          font-size: 14px;
          background: #f5f7fa;
          color: #2d3748;
          min-height: 100vh;
        }

        /* ── Header ── */
        header {
          background: linear-gradient(135deg, #1a1a2e 0%, #16213e 60%, #0f3460 100%);
          color: #fff;
          padding: 32px 40px 28px;
          display: flex;
          align-items: center;
          gap: 20px;
          box-shadow: 0 2px 12px rgba(0,0,0,.35);
        }
        .header-logo {
          width: 48px;
          height: 48px;
          background: #f97316;
          border-radius: 12px;
          display: flex;
          align-items: center;
          justify-content: center;
          font-size: 22px;
          font-weight: 800;
          color: #fff;
          flex-shrink: 0;
          letter-spacing: -1px;
        }
        .header-text h1 {
          font-size: 22px;
          font-weight: 700;
          letter-spacing: -0.3px;
        }
        .header-text p {
          font-size: 13px;
          color: rgba(255,255,255,.6);
          margin-top: 3px;
        }
        .header-badge {
          margin-left: auto;
          background: rgba(249,115,22,.15);
          border: 1px solid rgba(249,115,22,.4);
          color: #fb923c;
          font-size: 12px;
          font-weight: 600;
          padding: 4px 12px;
          border-radius: 20px;
        }

        /* ── Main ── */
        main {
          max-width: 1200px;
          margin: 32px auto;
          padding: 0 20px 40px;
        }

        /* ── Table ── */
        .sitemap-section {
          margin-bottom: 34px;
        }
        .section-heading {
          display: flex;
          align-items: center;
          justify-content: space-between;
          gap: 16px;
          margin: 0 0 12px;
        }
        .section-heading h2 {
          font-size: 18px;
          font-weight: 700;
          color: #1a1a2e;
        }
        .section-heading span {
          background: #fff;
          border: 1px solid #e2e8f0;
          color: #4a5568;
          border-radius: 20px;
          padding: 5px 12px;
          font-size: 12px;
          font-weight: 700;
          white-space: nowrap;
        }

        table {
          width: 100%;
          border-collapse: collapse;
          background: #fff;
          border-radius: 12px;
          overflow: hidden;
          box-shadow: 0 1px 8px rgba(0,0,0,.08), 0 0 0 1px rgba(0,0,0,.05);
        }
        thead tr {
          background: #1a1a2e;
          color: #fff;
        }
        th {
          padding: 13px 16px;
          text-align: left;
          font-size: 12px;
          font-weight: 600;
          text-transform: uppercase;
          letter-spacing: .6px;
          white-space: nowrap;
        }
        td {
          padding: 11px 16px;
          border-bottom: 1px solid #edf2f7;
          vertical-align: middle;
          word-break: break-all;
        }
        tbody tr:last-child td { border-bottom: none; }
        tbody tr:hover { background: #fafbff; }

        td.num {
          color: #a0aec0;
          font-size: 12px;
          width: 42px;
          text-align: center;
          word-break: normal;
        }
        td.meta {
          color: #718096;
          font-size: 12px;
          white-space: nowrap;
          word-break: normal;
        }
        td a {
          color: #3182ce;
          text-decoration: none;
          font-size: 13px;
        }
        td a:hover { text-decoration: underline; color: #f97316; }

        /* ── Priority badge ── */
        .badge {
          display: inline-block;
          padding: 2px 8px;
          border-radius: 20px;
          font-size: 11px;
          font-weight: 700;
          min-width: 36px;
          text-align: center;
        }
        .badge-high   { background: #c6f6d5; color: #276749; }
        .badge-mid    { background: #fefcbf; color: #744210; }
        .badge-low    { background: #e2e8f0; color: #4a5568; }

        /* ── Footer ── */
        footer {
          text-align: center;
          padding: 20px;
          font-size: 12px;
          color: #a0aec0;
        }
        footer a { color: #f97316; text-decoration: none; }
      </style>
    </head>
  </xsl:template>

  <xsl:template name="header">
    <xsl:param name="heading"/>
    <xsl:param name="subheading"/>
    <header>
      <div class="header-logo">M</div>
      <div class="header-text">
        <h1><xsl:value-of select="$heading"/></h1>
        <p><xsl:value-of select="$subheading"/></p>
      </div>
      <span class="header-badge">Motokloz.com</span>
    </header>
  </xsl:template>

  <xsl:template name="footer">
    <footer>
      <p>Generated by <a href="https://motokloz.com">Motokloz.com</a> — XML Sitemap</p>
    </footer>
  </xsl:template>

  <xsl:template name="priority-badge">
    <xsl:param name="val"/>
    <xsl:choose>
      <xsl:when test="$val >= 0.8">
        <span class="badge badge-high"><xsl:value-of select="$val"/></span>
      </xsl:when>
      <xsl:when test="$val >= 0.5">
        <span class="badge badge-mid"><xsl:value-of select="$val"/></span>
      </xsl:when>
      <xsl:otherwise>
        <span class="badge badge-low"><xsl:value-of select="$val"/></span>
      </xsl:otherwise>
    </xsl:choose>
  </xsl:template>

</xsl:stylesheet>
