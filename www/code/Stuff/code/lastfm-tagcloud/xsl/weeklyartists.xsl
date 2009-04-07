<?xml version="1.0" encoding="ISO-8859-1"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	
	<xsl:output method='html' indent='yes' omit-xml-declaration='yes' />

	<!-- Variables -->
	
	<xsl:variable name="list_class">tagcloud</xsl:variable>
	
	<!-- Control Variables -->
	<xsl:variable name="max_artists" select="20"/>
	<xsl:variable name="min_playcount" select="2" />

	<!-- Size Variables -->
	<xsl:variable name="size_max" select="4" />
	<xsl:variable name="size_min" select="1" />

	<!-- Initialisation -->
	<xsl:variable name="size_range" select="$size_max - $size_min" />
	<xsl:variable name="max_playcount" select="$artists/playcount" />
	<xsl:variable name="artists" select="/weeklyartistchart/artist[playcount &gt;= $min_playcount and position() &lt;= $max_artists]" />
	
	<!-- Root Template -->
	<xsl:template match="/">

		<ol>
			<xsl:attribute name="class">
				 <xsl:value-of select="$list_class" />
			</xsl:attribute>

			<xsl:apply-templates select="$artists">
				<xsl:sort select="name"/>  
		    </xsl:apply-templates>
		</ol>
    </xsl:template>

	<!-- Artist Template -->
	<xsl:template match="artist">
		
		<xsl:variable name="weight" select="playcount div $max_playcount" />
		<xsl:variable name="size" select="($weight * $size_range) + $size_min" />
		
		<li>
			
			<xsl:attribute name='style'> 
				font-size: <xsl:value-of select="format-number($size, '#.000')" />em;
			</xsl:attribute>
			
			<span>
				<span class="weighting"><xsl:value-of select="playcount"/></span> listens to
			</span>
			
			<a>
				<xsl:attribute name="href">
					<xsl:value-of select="url" />
				</xsl:attribute>
			
				<xsl:attribute name="title">
					<xsl:value-of select="name" /> (<xsl:value-of select="playcount"/> listens)
				</xsl:attribute>
				
				<xsl:value-of select="name" />
			</a>
			
		</li>
		
	</xsl:template>
	
</xsl:stylesheet>
