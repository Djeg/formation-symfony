# Le format YAML

C'est un format de configuration simplifié utilisé par symfony.
Il comporte un système de clefs et de valeurs

```yaml
# Ceci est commentaire
nom: true # boolean
nom: 52.3 # nombre
nom: "Coucou" # string

notes: [13, 12, 18, 9] # array
notes: # multiline array
  - 13
  - 12
  - 18
  - 9

user: # objects
  name: "John"
  age: 32
  notes:
    - 13
    - 14
    - 16
    - 8
```
