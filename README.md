# Webcamviewer_XH

Webcamviewer_XH facilitates displaying an image that will be refreshed
after some customizable interval.
Its intended use is to display the current snapshot of a webcam,
which places the most recent image in the same place.

- [Requirements](#requirements)
- [Download](#download)
- [Installation](#installation)
- [Settings](#settings)
- [Usage](#usage)
- [Troubleshooting](#troubleshooting)
- [License](#license)
- [Credits](#credits)

## Requirements

Webcamviewer_XH is a plugin for CMSimple_XH.
It requires CMSimple_XH ≥ 1.7.0 and PHP ≥ 7.0.0.
JavaScript has to be enabled in a contemporary browser to let
the images be automatically refreshed.

## Download

The [lastest release](https://github.com/cmb69/webcamviewer_xh/releases/latest)
is available for download on Github.

## Installation

The installation is done as with many other CMSimple_XH plugins. See the
[CMSimple_XH Wiki](https://wiki.cmsimple-xh.org/?for-users/working-with-the-cms/plugins)
for further details.

1. Backup the data on your server.
1. Unzip the distribution on your computer.
1. Upload the whole folder `webcamviewer/` to your server into
   the `plugins/` folder of CMSimple_XH.
1. Set write permissions to the subfolders `config/` and `languages/`.
1. Navigate to `Webcamviewer` in the back-end to check
   if all requirements are fulfilled.

## Settings

The configuration of the plugin is done as with many other CMSimple_XH plugins
in the back-end of the Website. Go to `Plugins` → `Webcamviewer`.

You can change the default settings of Webcamviewer_XH under `Config`.
Hints for the options will be displayed
when hovering over the help icon with your mouse.

Localization is done in `Language`. You can translate the character strings
to your own language if there is no appropriate language file available, or
customize them according to your needs.

## Usage

Every image that shall be refreshed periodically after the configured
interval has to be given the CSS class `webcamviewer`.

## Troubleshooting

Report bugs and ask for support either on
[Github](https://github.com/cmb69/webcamviewer_xh/issues)
or in the [CMSimple_XH Forum](https://cmsimpleforum.com/).

## License

Webcamviewer_XH is free software: you can redistribute it and/or modify it
under the terms of the GNU General Public License as published
by the Free Software Foundation, either version 3 of the License,
or (at your option) any later version.

Webcamviewer_XH is distributed in the hope that it will be useful,
but without any warranty; without even the implied warranty of merchantibility
or fitness for a particular purpose.
See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Webcamviewer_XH. If not, see https://www.gnu.org/licenses/.

© 2012-2023 Christoph M. Becker

## Credits

Webcamviewer was inspired by *wolfgang_58*.

The plugin icon is designed by [Alessandro Rei](http://www.mentalrey.it/).
Many thanks for publishing this icon under GPL.

And last but not least many thanks to [Peter Harteg](http://www.harteg.dk/),
the “father” of CMSimple,
and all developers of [CMSimple_XH](https://www.cmsimple-xh.org/)
without whom this amazing CMS would not exist.
