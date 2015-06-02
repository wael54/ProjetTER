<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="2.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="/">

	<xsl:param name="br">
			<xsl:text>&#xa;</xsl:text>
		</xsl:param>

		<xsl:value-of select="$br" /> 
	 <mots>
 
 <xsl:for-each select="mots/mot">
     <xsl:for-each select="entree">
         <xsl:if test="(CA='-7' or  CA='-8' or CA='-9')">
            <xsl:value-of select="$br" />
            <xsl:text disable-output-escaping="yes">  </xsl:text>
 			   <xsl:text disable-output-escaping="yes">&#60;mot id="</xsl:text><xsl:value-of select="M/@mot"/>"<xsl:text disable-output-escaping="yes">&#62;</xsl:text>
 			   
     <xsl:for-each select="../entree">
           <xsl:if test="(CA='-7' or  CA='-8' or CA='-9')">
         <xsl:value-of select="$br"/>
             <xsl:text disable-output-escaping="yes">   </xsl:text> 
      	<entree> 
      	   <xsl:value-of select="$br"/>
      	   <xsl:text disable-output-escaping="yes">    </xsl:text>
      	   <xsl:value-of select="$br"/> 
      	   <xsl:text disable-output-escaping="yes">    </xsl:text>
      	   <domaine> <xsl:value-of select="DOM"/> </domaine>
      	   <xsl:value-of select="$br"/> 
      	   <xsl:text disable-output-escaping="yes">    </xsl:text>
      	   <op1> <xsl:value-of select="OP1"/> </op1>œ
      	     <xsl:value-of select="$br"/>
      	     <xsl:text disable-output-escaping="yes">    </xsl:text>
      	   <op> <xsl:value-of select="OP"/> </op>
      	     <xsl:value-of select="$br"/>
      	     <xsl:text disable-output-escaping="yes">    </xsl:text>
      	   <sens><xsl:value-of select="SENS"/></sens>
      	   <xsl:value-of select="$br"/>
      	   <xsl:text disable-output-escaping="yes">   </xsl:text> 
      	   
      	   
			<xsl:if test="(CA='-7' or  CA='-8' or CA='-9')">            
      	   <op2>vivant</op2>
      	    <xsl:value-of select="$br"/>
      	   <xsl:text disable-output-escaping="yes">   </xsl:text>   
      	  </xsl:if>
      	  
      	  <xsl:if test="(CA='-1' or  CA='-2' or CA='-3' or CA='A1' or CA='A2' or CA='A3' )">
      	  
      	    <op2>qc</op2>
      	   <xsl:value-of select="$br"/>
      	   <xsl:text disable-output-escaping="yes">   </xsl:text>   
      	  </xsl:if>
      	  
      	  
      	  
      	  
      	</entree>
       </xsl:if>
     </xsl:for-each>
     <xsl:value-of select="$br" />
     <xsl:text disable-output-escaping="yes">  </xsl:text>  
       <xsl:text disable-output-escaping="yes">&#60;&#47;mot&#62;</xsl:text>
          </xsl:if>
     </xsl:for-each> 
 </xsl:for-each>
 
</mots>
  
  
</xsl:template>
</xsl:stylesheet> 