PHPCI=pci.bat
SVN=svn

.PHONY: pci
pci:
	$(PHPCI) -id pcidirs.txt -d .

.PHONY: export
export:
	$(SVN) export -q . webcamviewer/
	rm -rf webcamviewer/webcamviewer.komodoproject webcamviewer/Makefile webcamviewer/pcidirs.txt
	cp webcamviewer/config/config.php webcamviewer/config/defaultconfig.php
	cp webcamviewer/languages/en.php webcamviewer/languages/default.php
