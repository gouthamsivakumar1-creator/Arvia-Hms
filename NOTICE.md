# Notice

Arvia HMS is a modified version of [ICTHospital](https://github.com/ictinnovations/ICTHospital),
Copyright (c) ICT Innovations, licensed under the GNU General Public License v3.0 only.
See [LICENSE](LICENSE). Upstream copyright notices in source files are retained.

Modified for Arvia Biotech Pvt Ltd, starting 31 October 2026 from upstream commit 5ac2761:

- Arvia branding, with a placeholder logo
- ABHA number replaces CNIC on patient records
- India timezone and demo data defaults
- `App\\Models\\SMS` renamed to `SmsFormat`, because it clashed with `Sms` on case-insensitive disks
- The default ICTCore server URL was removed, so messaging must be pointed at a chosen gateway
