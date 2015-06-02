<?xml version="1.0" encoding="iso-8859-1" ?>

<xsl:stylesheet version="2.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

	<xsl:output method="text" encoding="UTF-8"
		doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"
		doctype-public="-//W3C//DTD XHTML 1.0 Strict//FR" />

	<xsl:template match="mots">
		<xsl:apply-templates select="mot" />
	</xsl:template>

	<xsl:template match="entree">
		INSERT INTO verbe VALUES('<xsl:value-of select="../@id" disable-output-escaping="yes" />','<xsl:value-of select="domaine" disable-output-escaping="yes" />','<xsl:value-of select="op" disable-output-escaping="yes" />','<xsl:value-of select="sens" disable-output-escaping="yes" />','<xsl:value-of select="op2" disable-output-escaping="yes" />');
		<xsl:apply-templates select="entree" />
	</xsl:template>
</xsl:stylesheet>