# Webcamviewer_XH

Webcamviewer_XH ermöglicht es ein Bild anzuzeigen,
das nach einem einstellbaren Intervall aktualisiert wird.
Das Plugin ist vorgesehen, um den aktuellen Schnappschuss einer Webcam darzustellen,
die das jeweils neuste Bild am selben Ort ablegt.

- [Voraussetzungen](#voraussetzungen)
- [Download](#download)
- [Installation](#installation)
- [Einstellungen](#einstellungen)
- [Verwendung](#verwendung)
- [Problembehebung](#problembehebung)
- [Lizenz](#lizenz)
- [Danksagung](#danksagung)

## Voraussetzungen

Webcamviewer_XH ist ein Plugin für CMSimple_XH.
Es benötigt CMSimple_XH ≥ 1.7.0 und PHP > 7.0.0.
JavaScript muss in einem zeitgemäßen Browser aktiviert sein,
damit die Bilder automatisch aktualisiert werden.

## Download

Das [aktuelle Release](https://github.com/cmb69/webcamviewer_xh/releases/latest)
kann von Github herunter geladen werden.

## Installation

The Installation erfolgt wie bei vielen anderen CMSimple_XH-Plugins auch.
Im [CMSimple_XH-Wiki](https://wiki.cmsimple-xh.org/de/?fuer-anwender/arbeiten-mit-dem-cms/plugins)
finden Sie weitere Informationen.

1. Sichern Sie die Daten auf Ihrem Server.
1. Entpacken Sie die ZIP-Datei auf Ihrem Computer.
1. Laden Sie den gesamten Ordner `webcamviewer/` auf Ihren Server in den
   `plugins/` Ordner von CMSimple_XH hoch.
1. Vergeben Sie Schreibrechte für die Unterordner `config/` und `languages/`.
1. Gehen Sie zu `Webcamviewer` im Administrationsbereich,
   um zu prüfen, ob alle Voraussetzungen erfüllt sind.

## Einstellungen

Die Konfiguration des Plugins erfolgt wie bei vielen anderen
CMSimple_XH-Plugins auch im Administrationsbereich der Homepage.
Gehen Sie zu `Plugins` → `Webcamviewer`.

Sie können die Voreinstellungen von Webcamviewer_XH unter `Konfiguration` ändern.
Beim Überfahren der Hilfe-Icons mit der Maus werden Hinweise zu den
Einstellungen angezeigt.

Die Lokalisierung wird unter `Sprache` vorgenommen. Sie können die
Sprachtexte in Ihre eigene Sprache übersetzen, falls keine entsprechende
Sprachdatei zur Verfügung steht, oder sie entsprechend Ihren Anforderungen
anpassen.

## Verwendung

Jedem Bild, das periodisch zum eingestellten Intervall aktualisiert werden
soll, muss die CSS Klasse `webcamviewer` gegeben werden.

## Problembehebung

Melden Sie Programmfehler und stellen Sie Supportanfragen entweder auf
[Github](https://github.com/cmb69/webcamviewer_xh/issues)
oder im [CMSimple_XH Forum](https://cmsimpleforum.com/).

## Lizenz

Webcamviewer_XH ist freie Software. Sie können es unter den Bedingungen
der GNU General Public License, wie von der Free Software Foundation
veröffentlicht, weitergeben und/oder modifizieren, entweder gemäß
Version 3 der Lizenz oder (nach Ihrer Option) jeder späteren Version.

Die Veröffentlichung von Webcamviewer_XH erfolgt in der Hoffnung, dass es
Ihnen von Nutzen sein wird, aber *ohne irgendeine Garantie*, sogar ohne
die implizite Garantie der *Marktreife* oder der *Verwendbarkeit für einen
bestimmten Zweck*. Details finden Sie in der GNU General Public License.

Sie sollten ein Exemplar der GNU General Public License zusammen mit
Webcamviewer_XH erhalten haben. Falls nicht, siehe <https://www.gnu.org/licenses/>.

© 2012-2023 Christoph M. Becker

## Danksagung

Webcamviewer wurde von *wolfgang_58* inspiriert.

Das Plugin-Icon wurde von [Alessandro Rei](http://www.mentalrey.it/) entworfen.
Vielen Dank für die Veröffentlichung unter GPL.

Und zu guter letzt vielen Dank an [Peter Harteg](http://www.harteg.dk/),
den „Vater“ von CMSimple,
und allen Entwicklern von [CMSimple_XH](https://www.cmsimple-xh.org/de/)
ohne die es dieses phantastische CMS nicht gäbe.
