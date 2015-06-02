.PHONY :xsl-sujet

all: xsl-animauXML


xsl-animauXML:
			java -jar saxon9he.jar  LVF.xml  verbe.xsl > verbeT.sql


clean:
	find ./ -name '*~' -exec rm '{}' \; -print -or -name ".*~" -exec rm {} \; -print
	
	
