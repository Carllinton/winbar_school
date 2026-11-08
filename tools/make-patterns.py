"""Generate v3 background art. Usage: python3 make-patterns.py assets/img
Writes:
  bg-scatter.svg  faint scattered geometric shapes, tiled over the graph-paper grid
  corner-art.svg  bolder corner shapes for the hero and title bands"""
import sys, os
out = sys.argv[1]
C = dict(cobalt="#1F4FD1", crimson="#C0283F", emerald="#12805A", gold="#EAA800", ink="#262B36")

def scatter(op=0.06):
    s = [
        f'<path d="M30 110 a36 36 0 0 1 72 0 z" fill="{C["cobalt"]}" fill-opacity="{op}"/>',
        f'<circle cx="250" cy="60" r="22" fill="none" stroke="{C["crimson"]}" stroke-opacity="{op}" stroke-width="6"/>',
        f'<path d="M180 175 l28 48 h-56 z" fill="{C["emerald"]}" fill-opacity="{op}"/>',
        f'<path d="M305 210 v30 M290 225 h30" stroke="{C["gold"]}" stroke-opacity="{op*1.8}" stroke-width="7" stroke-linecap="round"/>',
        f'<path d="M36 290 l14 -14 l14 14 l14 -14 l14 14" fill="none" stroke="{C["cobalt"]}" stroke-opacity="{op}" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/>',
        f'<rect x="80" y="196" width="20" height="20" fill="{C["crimson"]}" fill-opacity="{op}" transform="rotate(45 90 206)"/>',
        f'<path d="M260 300 h40 v40 a40 40 0 0 1 -40 -40 z" fill="{C["gold"]}" fill-opacity="{op*1.4}"/>',
    ]
    return ('<svg xmlns="http://www.w3.org/2000/svg" width="360" height="360" viewBox="0 0 360 360">\n  '
            + "\n  ".join(s) + "\n</svg>\n")

def corners():
    return f'''<svg xmlns="http://www.w3.org/2000/svg" width="480" height="300" viewBox="0 0 480 300">
  <circle cx="400" cy="40" r="78" fill="{C["crimson"]}" fill-opacity="0.16"/>
  <circle cx="300" cy="120" r="40" fill="none" stroke="{C["cobalt"]}" stroke-opacity="0.2" stroke-width="12"/>
  <path d="M330 300 a74 74 0 0 1 148 0 z" fill="{C["emerald"]}" fill-opacity="0.16"/>
  <path d="M200 250 l16 -16 l16 16 l16 -16 l16 16" fill="none" stroke="{C["gold"]}" stroke-opacity="0.7" stroke-width="7" stroke-linecap="round" stroke-linejoin="round"/>
  <rect x="440" y="170" width="26" height="26" fill="{C["gold"]}" fill-opacity="0.55" transform="rotate(45 453 183)"/>
</svg>
'''

open(os.path.join(out, "bg-scatter.svg"), "w").write(scatter())
open(os.path.join(out, "corner-art.svg"), "w").write(corners())
print("wrote bg-scatter.svg and corner-art.svg")
