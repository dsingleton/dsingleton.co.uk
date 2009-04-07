<?xml version="1.0" encoding="UTF-8" ?>
<xsl:stylesheet exclude-result-prefixes="rdf rss l dc admin content xsl"
  version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
                xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
                xmlns:rss="http://purl.org/rss/1.0/"
                xmlns:dc="http://purl.org/dc/elements/1.1/"
                xmlns:admin="http://webns.net/mvcb/"
                xmlns:l="http://purl.org/rss/1.0/modules/link/"
                xmlns:content="http://purl.org/rss/1.0/modules/content/">
	<xsl:output omit-xml-declaration="yes"/>

	<xsl:template match="/rdf:RDF">
		<ul>
			<xsl:apply-templates select="rss:item" />
		</ul>
	</xsl:template>

	<xsl:template match="rss:item">
		<li>
			<xsl:element name="a">
				<xsl:attribute name="href">
					<xsl:value-of select="rss:link"/>
				</xsl:attribute>
				<xsl:value-of select="rss:title"/>
			</xsl:element>
		</li>
	</xsl:template>

	<xsl:template match="/rss">
		<ul>
			<xsl:apply-templates select="channel" />
		</ul>
	</xsl:template>

	<xsl:template match="channel">
		<xsl:for-each select="item">
			<li>
				<xsl:element name="a">
					<xsl:attribute name="href">
						<xsl:value-of select="link"/>
					</xsl:attribute>
					<xsl:value-of select="title"/>
				</xsl:element>
			</li>
		</xsl:for-each>
	</xsl:template>

</xsl:stylesheet>

